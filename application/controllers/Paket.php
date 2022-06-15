<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PaketModel');
		$this->load->helper('upload');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'master-data', 'sub_menu_active' => 'paket']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/paket',
			'plugin' => 'plugins/paket',
			'css' => 'css/paket',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetPaket()
	{
		$data = array();
		$paket = $this->PaketModel->GetPaket()->result();
		foreach ($paket as $pk => $val) {
			$data[] = array(
				'id_packet' => $val->id_packet,
				'packet_name' => $val->packet_name,
				'packet_duration' => $val->packet_duration,
				'packet_price' => $val->packet_price,
				'packet_price_slug' => substr_replace($val->packet_price, 'K', -3),
				'packet_description' => $val->packet_description,
				'membership' => $val->membership,
				'created_at' => $val->created_at,
				'updated_at' => $val->updated_at,
				'packet_images' => $this->PaketModel->GetPacketImages($val->id_packet)->result()
			);
		}
		echo json_encode($data);
	}

	public function GetPaketById($id)
	{
		// $data = array();
		$paket = $this->PaketModel->GetPaketById($id)->row();
		
		// echo $this->db->last_query($paket);
		// die;
		// var_dump($paket);
		// die;

		$data = array(
			'id_packet' => $paket->id_packet,
			'packet_name' => $paket->packet_name,
			'packet_duration' => $paket->packet_duration,
			'packet_price' => $paket->packet_price,
			'packet_price_slug' => substr_replace($paket->packet_price, 'K', -3),
			'packet_description' => $paket->packet_description,
			'membership' => $paket->membership,
			'created_at' => $paket->created_at,
			'updated_at' => $paket->updated_at,
			'packet_images' => $this->PaketModel->GetPacketImages($paket->id_packet)->result()
		);

		echo json_encode($data);
	}

	public function add()
	{
		$image = array();
		$this->form_validation->set_rules('packet_name', 'Nama Paket', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('packet_price', 'Harga Paket', 'required|numeric');
		$this->form_validation->set_rules('packet_description', 'Deskripsi Paket', 'required|min_length[10]');
		$this->form_validation->set_rules('packet_duration', 'Durasi Paket', 'required');
		$this->form_validation->set_rules('membership', 'Membership', 'required');

		if ($this->form_validation->run() == true) {
			$data['packet_name'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_name'), ENT_QUOTES));
			$data['packet_duration'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_duration'), ENT_QUOTES));
			$data['packet_price'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_price'), ENT_QUOTES));
			$data['packet_description'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_description'), ENT_QUOTES));
			$data['packet_price'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_price'), ENT_QUOTES));
			$data['membership'] = str_replace("'", "", htmlspecialchars($this->input->post('membership'), ENT_QUOTES));

			if (!empty($_FILES['image1']['name'])) {
                $upload = h_upload($_FILES['image1']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image1');

                if (!empty($upload['success'])) {
                    $image[]['image_name'] = $upload['success']['file_name'];
                }
            }

            if (!empty($_FILES['image2']['name'])) {
                $upload = h_upload($_FILES['image2']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image2');

                if (!empty($upload['success'])) {
                    $image[]['image_name'] = $upload['success']['file_name'];
                }
            }

            if (!empty($_FILES['image3']['name'])) {
                $upload = h_upload($_FILES['image3']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image3');

                if (!empty($upload['success'])) {
                    $image[]['image_name'] = $upload['success']['file_name'];
                }
            }

            if (!empty($_FILES['image4']['name'])) {
                $upload = h_upload($_FILES['image4']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image4');

                if (!empty($upload['success'])) {
                    $image[]['image_name'] = $upload['success']['file_name'];
                }
            }

            if (!empty($_FILES['image5']['name'])) {
                $upload = h_upload($_FILES['image5']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image5');

                if (!empty($upload['success'])) {
                    $image[]['image_name'] = $upload['success']['file_name'];
                }
            }

			$act = $this->PaketModel->add($data, $image);

			if ($act) {
				$response = array(
					'type' => 'success',
					'title' => 'Berhasil !!!',
					'message' => 'Data paket berhasil di tambah.'
				);
			} else {
				$response = array(
					'type' => 'warning',
					'title' => 'Gagal !!!',
					'message' => 'Data paket gagal di tambah !'
				);
			}
		} else {
			$response = array(
				'type' => 'error',
				'title' => 'Gagal !!!',
				'message' => validation_errors(),
			);
		}

		echo json_encode($response);
	}

	public function update()
	{
		$image = array();
		$this->form_validation->set_rules('packet_name', 'Nama Paket', 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('packet_price', 'Harga Paket', 'required|numeric');
		$this->form_validation->set_rules('packet_description', 'Deskripsi Paket', 'required|min_length[10]');
		$this->form_validation->set_rules('packet_duration', 'Durasi Paket', 'required');
		$this->form_validation->set_rules('membership', 'Membership', 'required');

		if ($this->form_validation->run() == true) {
			$id_packet = str_replace("'", "", htmlspecialchars($this->input->post('id_packet'), ENT_QUOTES));
			$data['packet_name'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_name'), ENT_QUOTES));
			$data['packet_duration'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_duration'), ENT_QUOTES));
			$data['packet_price'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_price'), ENT_QUOTES));
			$data['packet_description'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_description'), ENT_QUOTES));
			$data['packet_price'] = str_replace("'", "", htmlspecialchars($this->input->post('packet_price'), ENT_QUOTES));
			$data['membership'] = str_replace("'", "", htmlspecialchars($this->input->post('membership'), ENT_QUOTES));

			$image['packet_id'] = $id_packet;
            if (!empty($_FILES['image1']['name'])) {
                $upload = h_upload($_FILES['image1']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image1');

                if (!empty($upload['success'])) {
                    $image['image_name'] = $upload['success']['file_name'];
                }

                $insert = $this->PaketModel->addImage($image);
            }

            if (!empty($_FILES['image2']['name'])) {
                $upload = h_upload($_FILES['image2']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image2');

                if (!empty($upload['success'])) {
                    $image['image_name'] = $upload['success']['file_name'];
                }

                $insert = $this->PaketModel->addImage($image);
            }

            if (!empty($_FILES['image3']['name'])) {
                $upload = h_upload($_FILES['image3']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image3');

                if (!empty($upload['success'])) {
                    $image['image_name'] = $upload['success']['file_name'];
                }

                $insert = $this->PaketModel->addImage($image);
            }

            if (!empty($_FILES['image4']['name'])) {
                $upload = h_upload($_FILES['image4']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image4');

                if (!empty($upload['success'])) {
                    $image['image_name'] = $upload['success']['file_name'];
                }

                $insert = $this->PaketModel->addImage($image);
            }

            if (!empty($_FILES['image5']['name'])) {
                $upload = h_upload($_FILES['image5']['name'], 'assets/img/packets', 'jpg|png|jpeg', '2048', 'image5');

                if (!empty($upload['success'])) {
                    $image['image_name'] = $upload['success']['file_name'];
                }

                $insert = $this->PaketModel->addImage($image);
            }


			$act = $this->PaketModel->update($data, $id_packet);

			if ($act) {
				$response = array(
					'type' => 'success',
					'title' => 'Berhasil !!!',
					'message' => 'Data paket berhasil di tambah.'
				);
			} else {
				$response = array(
					'type' => 'warning',
					'title' => 'Gagal !!!',
					'message' => 'Data paket gagal di tambah !'
				);
			}
		} else {
			$response = array(
				'type' => 'error',
				'title' => 'Gagal !!!',
				'message' => validation_errors(),
			);
		}

		echo json_encode($response);
	}

	 public function delete()
    {
        $id = str_replace("'", "", htmlspecialchars($this->input->post('id_packet'), ENT_QUOTES));

        $images = $this->PaketModel->GetPacketImages($id);

        if ($images->num_rows() > 0) {
            foreach ($images->result() as $img) {
                unlink('./assets/img/packets/' . $img->image_name);
            }
        }

        $act = $this->PaketModel->delete($id);
        if ($act) {
            $response = array(
                'type' => 'success',
                'title' => 'Berhasil !!!',
                'message' => 'Data paket berhasil dihapus.'
            );
        } else {
            $response = array(
                'type' => 'warning',
                'title' => 'Gagal !!!',
                'message' => 'Data paket gagal dihapus !'
            );
        }

        // log_activity('delete', 'delete paket', 'Data paket pada admin');
        echo json_encode($response);
    }

    public function removeImage()
    {
        $id = $this->input->post('id');
        $image = $this->db->get_where('packet_images', ['id_packet_images' => $id])->row();

        unlink('./assets/img/packets/' . $image->image_name);
        $this->db->delete('packet_images', ['id_packet_images' => $id]);

        $response = array(
            'type' => 'success',
            'title' => 'Berhasil !!!',
            'message' => 'File berhasil di hapus !'
        );

        echo json_encode($response);
    }
}
