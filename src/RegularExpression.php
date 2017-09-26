<?php

class RegularExpression {

    private $regExp , $flags;

    public function lookFor (string $string)
    {
        $this->regExp .= $string;

        return $this;
    }


    public function lookForGroup (string $string , bool $store = false)
    {
        $this->regExp .= ( ! $store) ? '(?:' . $string . ')' : '(' . $string . ')';

        return $this;
    }


    public function lookForSet (string $string)
    {
        $this->regExp .= '[' . $string . ']';

        return $this;
    }


    public function limit (int $min , int $max)
    {
        $this->regExp .= ( ! $max) ? '{' . $min . '}' : '{' . $min . ',' . $max . '}';

        return $this;
    }

    public function orThisGroup (string $string , bool $store = false)
    {
        $this->regExp .= '|';
        $this->lookForGroup($string , $store);

        return $this;

    }

    public function orThisSet (string $string)
    {
        $this->regExp .= '|';
        $this->lookForSet($string);

        return $this;

    }

    public function conditionalGroup (string $string , bool $store = false)
    {
        $this->lookForGroup($string , $store);
        $this->regExp .= '?';

        return $this;
    }

    public function regContinue (int $min = null, int $max = null)
    {
        if ( ! $min):
            $this->regExp .= '.+';
        elseif ($min && $max):
            $this->regExp .= '.{' . $min . ',' . $max . '}';
        else:
            $this->regExp .= '.{' . $min . '}';
        endif;

        return $this;
    }

    public function negateSet (string $string) {
        $this->regExp .= '[^' . $string . ']';
        return $this;
    }

    public function negateGroup (string $string) {
        $this->regExp .= '(^' . $string . ')';
        return $this;
    }


    public function ignoreCapitalization () {
        $this->flags .= 'i';
        return $this;
    }

    public function globalSearch () {
        $this->flags .= 'g';
        return $this;
    }


    public function generate ()
    {
        return '/' . $this->regExp . '/' . $this->flags;
    }


}
