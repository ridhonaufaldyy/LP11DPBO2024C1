<?php


interface KontrakPresenter
{
	public function prosesDataPasien();
	public function deletePasien($id);
	public function getTempat($i);
	public function getTl($i);
	public function getGender($i);
	public function getTelp($i);
	public function getEmail($i);

	public function getSize();
}
