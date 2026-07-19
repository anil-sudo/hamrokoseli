<?php

use App\Models\Category;

describe('Category parent handling', function () {
    it('treats an invalid parent id as a root category', function () {
        $category = Category::create([
            'cat_name' => 'Hand Craft',
            'slug' => 'hand-craft',
            'status' => 'active',
            'parent_cat_id' => 999,
        ]);

        expect($category->parent_cat_id)->toBeNull();
        expect(Category::count())->toBe(1);
    });
});
