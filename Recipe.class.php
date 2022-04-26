<?php

class Recipe
{
    /** @var int  */
    const CALORIES = 500;

    /** @var Ingredient[]  */
    private array $ingredients;

    /** @var int */
    private int $score;

    /** @var bool */
    private bool $isCalorieLimited;

    /**
     * @param Ingredient[] $ingredients
     */
    public function __construct(array $ingredients, bool $isCalorieLimited) {
        $this->isCalorieLimited = $isCalorieLimited;
        $this->score = 0;
        $this->optimizeRecipe($ingredients);
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return Ingredient[]
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * @param Ingredient[] $ingredients
     * @param int $ingredientNumber
     * @param int $totalTeaspoonCount
     * @return void
     */
    private function optimizeRecipe(array $ingredients, int $ingredientNumber = 0, int $totalTeaspoonCount = 100): void
    {
        if ($ingredientNumber == count($ingredients) - 1) {
            $ingredients[$ingredientNumber]->setTeaspoonCount($totalTeaspoonCount);
            $score = $this->calculateScore($ingredients);
            if ($score > $this->score) {
                $this->saveRecipe($ingredients, $score);
            }
            return;
        }
        for($i = 0; $i <= $totalTeaspoonCount; $i++) {
            $ingredients[$ingredientNumber]->setTeaspoonCount($i);
            $this->optimizeRecipe($ingredients, $ingredientNumber + 1, $totalTeaspoonCount - $i);
        }

    }

    /**
     * @param Ingredient[] $ingredients
     * @return int
     */
    private function calculateScore(array $ingredients): int
    {
        $capacity = 0;
        $durability = 0;
        $flavor = 0;
        $texture = 0;
        $calories = 0;

        foreach ($ingredients as $ingredient) {
            $capacity += $ingredient->getCapacity();
            $durability += $ingredient->getDurability();
            $flavor += $ingredient->getFlavor();
            $texture += $ingredient->getTexture();
            $calories += $ingredient->getCalories();
        }

        if ($this->isCalorieLimited && $calories != self::CALORIES) {
            return 0;
        }

        return $capacity * $durability * $flavor * $texture;
    }

    /**
     * @param Ingredient[] $ingredients
     * @param int $score
     * @return void
     */
    private function saveRecipe(array $ingredients, int $score): void
    {
        $this->score = $score;
        $this->saveIngredients($ingredients);
    }

    /**
     * @param Ingredient[] $ingredients
     * @return void
     */
    private function saveIngredients(array $ingredients): void
    {
        $this->ingredients = array();

        foreach ($ingredients as $k => $v) {
            $this->ingredients[$k] = clone $v;
        }
    }
}