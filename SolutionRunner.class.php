<?php

include 'IngredientParser.class.php';
include 'Recipe.class.php';
include 'Ingredient.class.php';

class SolutionRunner
{
    /**
     * @param string $ingredients_input
     * @param bool $isCalorieLimited
     * @return void
     */
    public static function runSolution(string $ingredients_input, bool $isCalorieLimited): void
    {
        $ingredients = self::getParsedIngredients($ingredients_input);
        $recipe = new Recipe($ingredients, $isCalorieLimited);
        echo "<h1>Score: " . $recipe->getScore() . "<h1> </br>";
        $recipe_output = "";
        foreach($recipe->getIngredients() as $ingredient) {
            $recipe_output .= sprintf("<h1>%s: %d teaspoons<h1>", $ingredient->getName(), $ingredient->getTeaspoonCount());
        }
        echo $recipe_output;
    }

    /**
     * @param string $ingredients_input
     * @return Ingredient[]|void
     */
    private static function getParsedIngredients(string $ingredients_input)
    {
        try {
            $ingredients = IngredientParser::parseIngredients($ingredients_input);
        } catch (Throwable $e) {
            echo "</br> </br> <h1>Something went wrong with parsing the ingredients </br> 
                    Please input the ingredients and their properties in the assignment's specified format</h1>";
            exit();
        }
        return $ingredients;
    }
}