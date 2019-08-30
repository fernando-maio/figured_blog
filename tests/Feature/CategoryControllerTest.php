<?php

namespace Tests\Feature;

use App\User;
use App\Categories;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class CategoryControllerTest extends TestCase
{
    /** @test */
    public function access_categories_without_authentication()
    {
        $user = factory(User::class)->make();
        $response = $this->get('/categories');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function categories_can_be_listed()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/categories');
        $response->assertStatus(200);
    }

    /** @test */
    public function categories_form_create_can_be_accessed()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/categories/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function a_category_can_be_created()
    {        
        $request = new Request;
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->post('/categories/create', array('name' => $request));
        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function a_category_form_edit_can_be_accessed()
    {
        $category = factory(Categories::class)->make();
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/categories/edit/' . $category->id);
        $response->assertStatus(200);
    }
}
