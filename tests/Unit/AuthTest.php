<!-- 

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\UserFactory;
use App\Models\User;

class AuthTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */
    public function test_auth_register(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_type' => 'admin',
        ];
       dd(User::create($userData));
    }
} -->
