<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $guarded = [];

    public function getValue($parfume_id) {
        $statistic = Statistic::where('parfume_id', $parfume_id)->where('criteria_id', $this->id)->first();
        if ($statistic) {
            $value = $statistic->value;
        }
        else {
            $value = 0;
        }
        return $value;
    }

    public function getRating($parfume_id) {
        if ($this->attribute == 'benefit') {
            if ($this->getValue($parfume_id) == 0 && $this->getMax() == 0) {
                $rating = 0;
            }
            else {
                $rating = $this->getValue($parfume_id) / $this->getMax();
            }
        }
        else {
            if ($this->getValue($parfume_id) == 0 && $this->getMin() == 0) {
                $rating = 0;
            }
            else {
                $rating = $this->getMin() / $this->getValue($parfume_id);
            }
        }
        return $rating;
    }

    public function getMax() {
        $value = Statistic::where('criteria_id', $this->id)->max('value');
        if ($value) {
            $max = $value;
        }
        else {
            $max = 0;
        }
        return $max;
    }

    public function getMin() {
        $value = Statistic::where('criteria_id', $this->id)->min('value');
        if ($value) {
            $min = $value;
        }
        else {
            $min = 0;
        }
        return $min;
    }

    public function getMinMax() {
        if ($this->attribute == 'benefit') {
            $value = $this->getMax();
        }
        else {
            $value = $this->getMin();
        }
        return $value;
    }
}
