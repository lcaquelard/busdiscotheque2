<?php

namespace App\Entity;
use App\Entity\Option;
use PhpParser\Node\Expr\Array_;

class OptionGroup
{
    private string $title;
    private string $name;
    private bool $display;
    private array $options = Array();

    public function __construct(string $name, string $title, bool $display = true){
        $this->name = $name;
        $this->title = stripslashes($title);
        $this->display = $display;
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

    public function getDisplay(): bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display)
    {
        $this->display = $display;
    }
    public function addOption($name, $title, $price, $text)
    {
        $this->options[$name] = new Option($name, $title, $price, $text);
    }

    public function removeOption($name): bool
    {
        if (array_key_exists($name, $this->options)){
            unlink($name, $this->options[$name]);
            return true;
        }
        return false;
    }

    public function hasOption($name): bool
    {
        return array_key_exists($name, $this->options);
    }

    public function getOption($name): Option | NULL
    {
        return (array_key_exists($name, $this->options)) ? $this->options[$name] : NULL;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

}