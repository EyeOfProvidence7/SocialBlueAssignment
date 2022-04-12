from itertools import combinations_with_replacement

_is_calorie_restricted = True


def get_all_recipes(ingredients):
    ingredient_indexes = [str(x) for x in range(len(ingredients))]
    ingredient_combinations = list(combinations_with_replacement(ingredient_indexes, 100))
    return [[combination.count(ingredient_indexes[x]) for x in range(len(ingredient_indexes))] for combination in
            ingredient_combinations]


def get_ingredients(file_name):
    ingredients = []
    with open(file_name) as fp:
        while True:
            line = fp.readline()
            if not line:
                break
            tokens = line.split(": ")[1].split(", ")
            ingredient_properties = []
            for token in tokens:
                ingredient_properties.append(int(token.split(" ")[1]))
            ingredients.append(ingredient_properties)
    return ingredients


def get_max_recipe_score(recipes, ingredients, is_calorie_restricted):
    max_score = 0
    for recipe in recipes:
        recipe = list(recipe)
        capacity = 0
        durability = 0
        flavor = 0
        texture = 0
        calories = 0

        for i in range(len(ingredients)):
            capacity += recipe[i] * ingredients[i][0]
            durability += recipe[i] * ingredients[i][1]
            flavor += recipe[i] * ingredients[i][2]
            texture += recipe[i] * ingredients[i][3]
            calories += recipe[i] * ingredients[i][4]

        if any([prop < 0 for prop in [capacity, durability, flavor, texture]]):
            continue

        score = capacity * durability * flavor * texture
        if is_calorie_restricted and calories == 500:
            max_score = max(score, max_score)
        elif not is_calorie_restricted:
            max_score = max(score, max_score)
    return max_score


def get_solution(is_calorie_restricted):
    ingredients = get_ingredients('ingredients.txt')
    recipes = get_all_recipes(ingredients)
    return get_max_recipe_score(recipes, ingredients, is_calorie_restricted)


print(get_solution(_is_calorie_restricted))
