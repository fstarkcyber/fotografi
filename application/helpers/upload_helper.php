
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function h_upload($nama, $lokasi, $tipe, $ukuran, $input)
{
    $CI = &get_instance();
    $config['upload_path'] = './' . $lokasi;
    $config['allowed_types'] = $tipe;
    $config['max_size'] = $ukuran;
    $config['overwrite'] = true;
    $config['file_name'] = $nama;
    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if (!$CI->upload->do_upload($input)) {
        $data['error'] = $CI->upload->display_errors();
    } else {
        $data['success'] = $CI->upload->data();
    }

    return $data;
}
