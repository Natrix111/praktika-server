<?php

use Model\Building;
use Model\User;
use PHPUnit\Framework\TestCase;
use Src\Request;

class BuildingTest extends TestCase
{
    private User $authUser;

    /**
     * @dataProvider buildingProvider
     * @runInSeparateProcess
     */
    public function testAddBuilding(string $httpMethod, array $buildingData, string $expected): void
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->any())
            ->method('all')
            ->willReturn($buildingData);
        $request->method = $httpMethod;

        ob_start();
        $result = (new \Controller\BuildingController())->add($request);
        $output = ob_get_clean();

        if ($httpMethod === 'GET') {
            $this->assertStringContainsString('<h2>Добавление здания</h2>', $output);
            $this->assertStringContainsString('<form method="post">', $output);
            return;
        }

        if (str_contains($expected, 'Location:')) {
            $building = Building::where('name', $buildingData['name'])->first();
            $this->assertNotNull($building);
            $this->assertEquals($buildingData['address'], $building->address);
            $this->assertEquals($this->authUser->id, $building->created_by);

            $this->assertTrue(headers_sent());
            $building->delete();
        } else {
            $this->assertStringContainsString('<div class="error-message">', $output);
            $errors = json_decode($expected, true);
            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $this->assertStringContainsString($message, $output);
                }
            }
        }
    }

    public function buildingProvider(): array
    {
        return [
            ['GET', ['name' => '', 'address' => '', 'area' => ''], ''],
            [
                'POST',
                ['name' => '', 'address' => '', 'area' => ''],
                '{"name":["Поле name обязательно"],"address":["Поле address обязательно"],"area":["Поле area должно быть числом","Поле area должно быть положительным числом"]}'
            ],
            [
                'POST',
                ['name' => 'школа 26', 'address' => 'Test', 'area' => 100],
                '{"name":["Поле name должно быть уникально"]}'
            ],
            [
                'POST',
                ['name' => 'New Building', 'address' => 'Test', 'area' => -100],
                '{"name":["Поле area должно быть положительным числом"]}'
            ],
            [
                'POST',
                ['name' => 'New Building ' . rand(1, 10000), 'address' => 'New Address', 'area' => 150],
                'Location: /'
            ]
        ];
    }

    protected function setUp(): void
    {
        $_SERVER['DOCUMENT_ROOT'] = '/OSPanel/domains/pop-it-mvc';

        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));

        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }

        $this->authUser = User::create([
            'name' => 'Test User',
            'login' => 'testuser_' . rand(1000, 9999),
            'password' => 'password',
            'role_id' => 1,
        ]);

        app()->auth->login($this->authUser);
    }

    protected function tearDown(): void
    {
        Building::where('created_by', $this->authUser->id)->delete();
        User::where('id', $this->authUser->id)->delete();
    }
}