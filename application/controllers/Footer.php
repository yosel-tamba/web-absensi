<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Footer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_crud');

        date_default_timezone_set('Asia/Jakarta');
    }

    public function aksi_update()
{
    // Form Validation Rules berdasarkan struktur kolom
    $this->form_validation->set_rules('nama', 'Nama', 'trim|max_length[100]');
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
    $this->form_validation->set_rules('deskripsi_developer', 'Deskripsi Developer', 'trim');
    $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|max_length[200]');
    $this->form_validation->set_rules('tiktok', 'TikTok', 'trim|max_length[200]');
    $this->form_validation->set_rules('instagram', 'Instagram', 'trim|max_length[200]');
    $this->form_validation->set_rules('facebook', 'Facebook', 'trim|max_length[200]');
    $this->form_validation->set_rules('copyright', 'Copyright', 'trim|max_length[100]');

    if ($this->form_validation->run() != false) {
        $id_footer = $this->input->post('id_footer');

        // Proses upload icon baru jika ada
        if (isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != '') {
            $nama_file = time() . "_" . str_replace(' ', '_', $_FILES['icon']['name']);
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 5120;
            $config['file_name'] = $nama_file;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('icon')) {
                $this->session->set_flashdata('failed', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
                return;
            } else {
                $icon = $nama_file;

                // Hapus icon lama jika ada
                $icon_lama = $this->input->post('icon_old');
                if ($icon_lama && file_exists('./assets/images/' . $icon_lama)) {
                    unlink('./assets/images/' . $icon_lama);
                }
            }
        } else {
            $icon = $this->input->post('icon_old'); // pakai yang lama
        }

        // Ambil input dan atur null jika kosong
        $data = [
            'icon' => $icon ?: null,
            'nama' => $this->input->post('nama') ?: null,
            'alamat' => $this->input->post('alamat') ?: null,
            'deskripsi_developer' => $this->input->post('deskripsi_developer') ?: null,
            'whatsapp' => $this->input->post('whatsapp') ?: null,
            'tiktok' => $this->input->post('tiktok') ?: null,
            'instagram' => $this->input->post('instagram') ?: null,
            'facebook' => $this->input->post('facebook') ?: null,
            'copyright' => $this->input->post('copyright') ?: null
        ];

        $where = ['id_footer' => $id_footer];
        $this->m_crud->update_data($where, $data, 'footer');
        $this->session->set_flashdata('success', 'Data footer berhasil diubah.');
    } else {
        $this->session->set_flashdata('failed', validation_errors());
    }

    redirect($_SERVER['HTTP_REFERER']);
}


}