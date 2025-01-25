<?php

namespace App\Support;

class Container {
    
    private array $instances = [];
    
    private array $recipes = [];
    
    public function bind(string $posts, \Closure $recipe) {
        $this->recipes[$posts] = $recipe;
    }

    public function get(string $posts) {
        if (empty($this->instances[$posts])) {
            if (empty($this->recipes[$posts])) {
                echo "Couldn't build: {$posts}.\n";
                die();
            }
            #if instance is empty then create instance 
            #by calling the function provided to recipes[$posts] via bind()
            $this->instances[$posts] = $this->recipes[$posts]();
        }
        return $this->instances[$posts];
    }
}