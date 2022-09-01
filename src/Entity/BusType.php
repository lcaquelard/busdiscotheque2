<?php

namespace App\Entity;

class BusType
{
    const options = array(
        'agent'     => 'Agent',
        'arcade'    => 'Pack Arcade',
        'bluetooth' => 'Bluetooth',
        'bubble'    => 'Machine à bulles',
        'carpet'    => 'Tapis rouge',
        'dj'        => 'DJ',
        'fridge'    => 'Espace frigorifié',
        'karaoke'   => 'Karaoké',
        'screen'    => 'Écran HD',
        'smoke'     => 'Machine à fumée',
        'soft'      => 'Softs inclus'
    );
    private string $name = '';
    private int $size = 0;
    private int $size_min = 0;
    private int $size_max = 0;
    private int $length = 0;
    private array $prices = array();
    private array $buses = array();
    private array $default_options = array();

    public function __construct(string $name, int $size, int $length, int $price, array $default_options, int $size_max = NULL, int $size_min = NULL){
        $this->name = $name;
        $this->size = $size;
        $this->size_max = $size_max?:$this->size;
        $this->size_min = $size_min?:$this->size_max;
        $this->length = $length;
        $this->prices = array(
            1 => $price,
            2 => $price + 100,
            3 => $price + 200,
            4 => $price + 300,
        );
        $this->default_options = $default_options;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size)
    {
        $this->size = $size;
    }

    public function getSizeMin(): int
    {
        return $this->size_min;
    }

    public function setSizeMin(int $size_min)
    {
        $this->size_min = $size_min;
    }

    public function getSizeMax(): int
    {
        return $this->size_max;
    }

    public function setSizeMax(int $size_max)
    {
        $this->size_max = $size_max;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getPrice(int $time): int
    {
        if (array_key_exists($time, $this->prices)) {
            return $this->prices[$time];
        } else {
            return 0;
        }
    }

    public function getPrices(): array
    {
        return $this->prices;
    }

    public function setPrice(int $time, int $price)
    {
        $this->price[$time] = $price;
    }

    public function getBuses(): array
    {
        return $this->buses;
    }

    public function addBus(string $name, string $short_name, int $room, int $pictures, $options = NULL)
    {
        $this->buses[] = new Bus($name, $short_name, $room, $pictures, $options?:$this->default_options);
    }

    public function getDefaultOptions(): array
    {
        return $this->default_options;
    }

    public function hasDefaultOption(string $option): bool
    {
        return array_key_exists($option, $this->default_options);
    }

    public function addDefaultOption(string $option)
    {
        $this->default_options[$option] = self::options[$option];
    }

    public function removeDefaultOption(string $option)
    {
        if (array_key_exists($option, $this->default_options))
            unset($this->default_options[$option]);
    }
}