<?php

namespace App\Entity;

class BusType
{
    const options = array(
        'agent'     => 'Agent',
        'arcade'    => 'Pack Arcade',
        'bluetooth' => 'Bluetooth',
        'bubble'    => 'Machine à bulles',
        'carpet_b'  => 'Tapis noir',
        'carpet_r'  => 'Tapis rouge',
        'dj'        => 'DJ',
        'fridge'    => 'Espace frigorifié',
        'karaoke'   => 'Karaoké',
        'screen'    => 'Écran HD',
        'smoke'     => 'Machine à fumée',
        'soft'      => 'Softs inclus'
    );
    private string $name            = '';
    private string $subtitle        = '';
    private int $size               = 0;
    private int $size_min           = 0;
    private int $size_max           = 0;
    private int $length             = 0;
    private array $prices           = array();
    private array $buses            = array();
    private array $default_options  = array();
    private bool $displayPage       = true;
    private bool $displayPrice      = true;
    private bool $external          = false;
    private string $target          = '';

    public function __construct(string $name, int $size, int $length, int $price, array $default_options, int $size_max = NULL, int $size_min = NULL, string $subtitle = '', bool $displayPrice = true, bool $displayPage = true, string $target = ''){
        $this->name             = $name;
        $this->subtitle         = $subtitle;
        $this->size             = $size;
        $this->size_max         = $size_max?:$this->size;
        $this->size_min         = $size_min?:$this->size_max;
        $this->length           = $length;
        $this->displayPage      = $displayPage;
        $this->displayPrice     = $displayPrice;
        if ($displayPage === true){
            if ($target != ''){
                $this->external = true;
                $this->target = $target;
            }
        }
        if ($displayPrice === true){
            $this->prices = array(
                1 => $price,
                2 => $price + 100,
                3 => $price + 200,
                4 => $price + 300,
                5 => $price + 400,
            );
            if (count($default_options) > 0) {
                foreach ($default_options as $option) {
                    $this->default_options[$option] = self::options[$option];
                }
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;
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
        $this->prices[$time] = $price;
    }

    public function getBuses(): array
    {
        return $this->buses;
    }

    public function addBus(string $name, string $shortname, int $room, int $pictures, string $subtitle = '', $specific_options = NULL)
    {
        if (isset($specific_options) && count($specific_options) > 0) {
            $options = array();
            foreach ($specific_options as $option) {
                $options[$option] = self::options[$option];
            }
        } else {
            $options = $this->default_options;
        }
        $this->buses[$shortname] = new Bus($name, $shortname, $room, $pictures, $subtitle, $options);
    }

    public function removeBus(string $shortname)
    {
        unset($this->buses[$shortname]);
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
        if (array_key_exists($option, self::options)) {
            $this->default_options[$option] = self::options[$option];
        }
    }

    public function isDisplayedPage(): bool
    {
        return $this->displayPage;
    }

    public function setDisplayPage(bool $displayPage)
    {
        $this->displayPage = $displayPage;
    }

    public function isDisplayedPrice(): bool
    {
        return $this->displayPrice;
    }

    public function setDisplayPrice(bool $displayPrice)
    {
        $this->displayPrice = $displayPrice;
    }

    public function isExternal(): bool
    {
        return $this->external;
    }

    public function setExternal(bool $external)
    {
        $this->external = $external;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function setTarget(string $target)
    {
        $this->target = $target;
    }
}