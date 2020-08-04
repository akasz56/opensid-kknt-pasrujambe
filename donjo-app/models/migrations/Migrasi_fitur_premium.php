<?php

/**
 * File ini:
 *
 * Model untuk modul database
 *
 * Migrasi_2007_ke_2008.php
 *
 */

/**
 *
 * File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:

 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.

 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package	OpenSID
 * @author	Tim Pengembang OpenDesa
 * @copyright	Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright	Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license	http://www.gnu.org/licenses/gpl.html	GPL V3
 * @link 	https://github.com/OpenSID/OpenSID
 */

class Migrasi_fitur_premium extends CI_model {

	public function up()
	{
		// Menu baru -FITUR PREMIUM-
		$this->buku_administrasi_desa();
	}

	private function buku_administrasi_desa()
	{
		// Menu parent Buku Administrasi Desa
		$menu[0] = array(
			'id'=>'301',
			'modul' => 'Buku Administrasi Desa',
			'url' => '',
			'aktif' => '1',
			'ikon' => 'fa-paste',
			'urut' => '6',
			'level' => '2',
			'hidden' => '0',
			'ikon_kecil' => 'fa fa-paste',
			'parent' => 0
		);
		$menu[1] = array(
			'id'=>'302',
			'modul' => 'Administrasi Umum',
			'url' => 'bumindes_umum',
			'aktif' => '1',
			'ikon' => 'fa-bookmark',
			'urut' => '1',
			'level' => '2',
			'hidden' => '0',
			'ikon_kecil' => 'fa fa-bookmark',
			'parent' => 301
		);
		$menu[2] = array(
			'id'=>'303',
			'modul' => 'Administrasi Penduduk',
			'url' => 'bumindes_penduduk',
			'aktif' => '1',
			'ikon' => 'fa-users',
			'urut' => '2',
			'level' => '2',
			'hidden' => '0',
			'ikon_kecil' => 'fa fa-users',
			'parent' => 301
		);
		$menu[3] = array(
			'id'=>'304',
			'modul' => 'Administrasi Keuangan',
			'url' => 'bumindes_keuangan',
			'aktif' => '1',
			'ikon' => 'fa-money',
			'urut' => '3',
			'level' => '2',
			'hidden' => '0',
			'ikon_kecil' => 'fa fa-money',
			'parent' => 301
		);
		$menu[4] = array(
			'id'=>'305',
			'modul' => 'Administrasi Pembangunan',
			'url' => 'bumindes_pembangunan',
			'aktif' => '1',
			'ikon' => 'fa-university',
			'urut' => '4',
			'level' => '2',
			'hidden' => '0',
			'ikon_kecil' => 'fa fa-university',
			'parent' => 301
		);
		$menu[5] = array(
			'id'=>'306',
			'modul' => 'Administrasi Lainnya',
			'url' => 'bumindes_lain',
			'aktif' => '1',
			'ikon' => 'fa-archive',
			'urut' => '5',
			'level' => '2',
			'hidden' => '0',
			'ikon_kecil' => 'fa fa-archive',
			'parent' => 301
		);
		foreach ($menu as $modul)
		{
			$sql = $this->db->insert_string('setting_modul', $modul);
			$sql .= " ON DUPLICATE KEY UPDATE
			id = VALUES(id),
			modul = VALUES(modul),
			url = VALUES(url),
			aktif = VALUES(aktif),
			ikon = VALUES(ikon),
			urut = VALUES(urut),
			level = VALUES(level),
			hidden = VALUES(hidden),
			ikon_kecil = VALUES(ikon_kecil),
			parent = VALUES(parent)";
			$this->db->query($sql);
		}
		// Menu parent Buku Administrasi Desa. END
		// Dokumen tidak harus ada file
	  $this->db->query('ALTER TABLE dokumen MODIFY satuan VARCHAR(200) NULL DEFAULT NULL;');
	  // Sembunyikan menu yg sdh masuk buku administrasi umum
	  $this->db->like('url', 'surat_keluar')->update('setting_modul', ['hidden' => 2]);
	  $this->db->like('url', 'surat_masuk')->update('setting_modul', ['hidden' => 2]);
	  $this->db->like('url', 'dokumen_sekretariat')->update('setting_modul', ['hidden' => 2]);
	}
}
