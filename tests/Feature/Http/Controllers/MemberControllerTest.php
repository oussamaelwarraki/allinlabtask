<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MemberController
 */
class MemberControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $members = Member::factory()->count(3)->create();

        $response = $this->get(route('member.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MemberController::class,
            'store',
            \App\Http\Requests\MemberStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password;

        $response = $this->post(route('member.store'), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
        ]);

        $members = Member::query()
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->where('email', $email)
            ->where('password', $password)
            ->get();
        $this->assertCount(1, $members);
        $member = $members->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $member = Member::factory()->create();

        $response = $this->get(route('member.show', $member));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MemberController::class,
            'update',
            \App\Http\Requests\MemberUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $member = Member::factory()->create();
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password;

        $response = $this->put(route('member.update', $member), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
        ]);

        $member->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($first_name, $member->first_name);
        $this->assertEquals($last_name, $member->last_name);
        $this->assertEquals($email, $member->email);
        $this->assertEquals($password, $member->password);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $member = Member::factory()->create();

        $response = $this->delete(route('member.destroy', $member));

        $response->assertNoContent();

        $this->assertModelMissing($member);
    }
}
