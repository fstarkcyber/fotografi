<?php

function singkat_angka($money)
{
	str_replace('000', 'K', $money);
}
