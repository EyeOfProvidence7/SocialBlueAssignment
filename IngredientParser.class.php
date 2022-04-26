<?php

class IngredientParser
{
    /**
     * @param string $ingredients_input
     * @return Ingredient[]
     */
    public static function parseIngredients(string $ingredients_input): array
    {
        $parsed_ingredients = [];
        $ingredients = preg_split("/\n/", $ingredients_input);
        foreach ($ingredients as $ingredient) {
            $parsed_ingredient = self::parseIngredient($ingredient);
            $parsed_ingredients[] = $parsed_ingredient;
        }
        return $parsed_ingredients;
    }

    /**
     * @param string $ingredient
     * @return Ingredient
     */
    private static function parseIngredient(string $ingredient): Ingredient
    {
        $ingredient = preg_split("/: /", $ingredient);
        $ingredient_properties = [];
        $property_tokens = preg_split("/, /", $ingredient[1]);
        $ingredient_properties['name'] = $ingredient[0];
        foreach ($property_tokens as $token) {
            $property = preg_split("/ /", $token);
            $ingredient_properties[$property[0]] = $property[1];
        }
        return new Ingredient(...$ingredient_properties);
    }
}