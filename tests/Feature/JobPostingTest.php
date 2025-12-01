<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobPostingTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_access_create_job_page()
    {
        $company = User::factory()->create(['role' => 'company']);
        $response = $this->actingAs($company)->get('/jobs/create');
        $response->assertStatus(200);
    }

    public function test_company_can_post_job()
    {
        $company = User::factory()->create(['role' => 'company']);
        $this->actingAs($company);
        $response = $this->post('/jobs', [
            'title' => 'Test Job',
            'description' => 'Desc',
            'location' => 'Jakarta',
            'job_type' => 'Full Time',
            'kategori' => 'IT',
            'min_salary' => 1000,
            'max_salary' => 2000,
        ]);
        $response->assertRedirect('/jobs');
        $this->assertDatabaseHas('jobs', ['title' => 'Test Job']);
    }
}
