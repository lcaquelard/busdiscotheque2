<?php

namespace App\Entity;

class Option
{
    private string $name;
    private string $title;
    private string $price;
    private string $text;

    public function __construct(string $name, string $title, string $price, string $text)
    {
        $this->name     = $name;
        $this->title    = stripslashes($title);
        $this->price    = stripslashes($price);
        $this->text     = stripslashes($text);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = stripslashes($title);
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price)
    {
        $this->price = stripslashes($price);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = stripslashes($text);
    }
}