<?php
namespace EdpDiscuss\Model\Visit;

interface VisitMapperInterface
{
	public function storeVisitIfUnique($visit);
}