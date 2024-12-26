<?php

namespace DifferDev\Interface;

interface ValidationHandler 
{
    public function execute(mixed $value): true;
}