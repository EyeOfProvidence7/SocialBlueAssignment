<?php

class Ingredient
{
    /** @var string */
    private string $name;

    /** @var int  */
    private int $capacity;

    /** @var int  */
    private int $durability;

    /** @var int  */
    private int $flavor;

    /** @var int  */
    private int $texture;

    /** @var int  */
    private int $calories;

    /** @var int */
    private int $teaspoonCount;

    /**
     * @param string $name
     * @param int $capacity
     * @param int $durability
     * @param int $flavor
     * @param int $texture
     * @param int $calories
     */
    function __construct(
        string $name,
        int $capacity,
        int $durability,
        int $flavor,
        int $texture,
        int $calories
    ){
        $this->name = $name;
        $this->capacity = $capacity;
        $this->durability = $durability;
        $this->flavor = $flavor;
        $this->texture = $texture;
        $this->calories = $calories;
        $this->teaspoonCount = 0;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity * $this->teaspoonCount;
    }

    /**
     * @return int
     */
    public function getDurability(): int
    {
        return $this->durability * $this->teaspoonCount;
    }

    /**
     * @return int
     */
    public function getFlavor(): int
    {
        return $this->flavor * $this->teaspoonCount;
    }

    /**
     * @return int
     */
    public function getTexture(): int
    {
        return $this->texture * $this->teaspoonCount;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories * $this->teaspoonCount;
    }


    /**
     * @param int $teaspoonCount
     * @return void
     */
    public function setTeaspoonCount(int $teaspoonCount): void
    {
        $this->teaspoonCount = $teaspoonCount;
    }

    /**
     * @return int
     */
    public function getTeaspoonCount(): int
    {
        return $this->teaspoonCount;
    }
}