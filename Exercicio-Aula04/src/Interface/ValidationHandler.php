<?php

namespace DifferDev\Interface;

interface ValidationHandler 
{
    public function execute(string $value): true;
}