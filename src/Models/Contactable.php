<?php
namespace Ry\Profile\Models;

interface Contactable
{
	public function getTypeAttribute();
	
	public function getCoordsAttribute();
}