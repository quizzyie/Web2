<?php
class ReviewsModel extends Model {
    protected $_table = 'reviews';

    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'reviews';
    }

    function fieldFill(){
        return "*";
    }
}