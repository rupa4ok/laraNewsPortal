<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
class UserTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $password;
    protected $userData;
    public function setUp()
    {
        parent::setUp();
        $this->password = Hash::make('password');
        $this->userData = [
            'name' => 'testName',
            'email' => 'test@domain.com',
            'password' => $this->password,
        ];
        $this->user = factory(User::class)->create($this->userData);
    }
    public function testGetLoginForm()
    {
        $response = $this->get(route('login'));
        $response->assertOk();
    }
    public function testGetRegisterForm()
    {
        $response = $this->get(route('register'));
        $response->assertOk();
    }
    public function testUserLogin()
    {
        $response = $this->post(route('login'), array_merge($this->userData, ['password' => 'password']));
        $response->assertRedirect(route('home'));
    }
    public function testUserLogout()
    {
        $response = $this->actingAs($this->user)->post('logout');
        $response->assertRedirect(route('index'));
    }
    public function testGetPasswordResetPage()
    {
        $response = $this->get(route('password.request'));
        $response->assertOk();
    }
    public function testUserChangePassword()
    {
        $user = factory(User::class)->create([
            'name' => 'testName',
            'email' => 'testEmail@domain.com'
        ]);
        $token = Password::createToken($user);
        $response = $this->post(route('password.request'), [
            'email' => 'testEmail@domain.com',
            'password' => 'newPass',
            'password_confirmation' => 'newPass',
            'token' => $token
        ]);
        $this->assertTrue(Hash::check('newPass', $user->fresh()->password));
    }
}