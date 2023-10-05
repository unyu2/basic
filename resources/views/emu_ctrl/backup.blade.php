function editForm2(url) {
        $('#modal-form2').modal('show');
        $('#modal-form2 .modal-title').text('Approve Inspeksi');

        $('#modal-form2 form')[0].reset();
        $('#modal-form2 form').attr('action', url);
        $('#modal-form2 [name=_method]').val('put');
        $('#modal-form2 [name=id_emu]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form2 [name=nama_proyek]').val(response.nama_proyek);
                $('#modal-form2 [name=id_emu]').val(response.id_emu);
                $('#modal-form2 [name=kode_emu]').val(response.kode_emu);
                $('#modal-form2 [name=status]').val(response.status);
                $('#modal-form2 [name=keterangan]').val(response.keterangan);
                $('#modal-form2 [name=id_user]').val(response.id_user);
                $('#modal-form2 [name=id_car]').val(response.id_car);


                $('#modal-form2 [name=nama_dmu1]').val(response.nama_dmu1);
                $('#modal-form2 [name=M1_1]').val(response.M1_1);
$('#modal-form2 [name=M2_1]').val(response.M2_1);
$('#modal-form2 [name=Mc1_1]').val(response.Mc1_1);
$('#modal-form2 [name=Mc2_1]').val(response.Mc2_1);
$('#modal-form2 [name=T1_1]').val(response.T1_1);
$('#modal-form2 [name=T2_1]').val(response.T2_1);
$('#modal-form2 [name=T3_1]').val(response.T3_1);
$('#modal-form2 [name=T4_1]').val(response.T4_1);
$('#modal-form2 [name=Tc1_1]').val(response.Tc1_1);
$('#modal-form2 [name=Tc2_1]').val(response.Tc2_1);
$('#modal-form2 [name=Tc3_1]').val(response.Tc3_1);
$('#modal-form2 [name=Tc4_1]').val(response.Tc4_1);


                $('#modal-form2 [name=nama_dmu2]').val(response.nama_dmu2);
                $('#modal-form2 [name=M1_2]').val(response.M1_2);
$('#modal-form2 [name=M2_2]').val(response.M2_2);
$('#modal-form2 [name=Mc1_2]').val(response.Mc1_2);
$('#modal-form2 [name=Mc2_2]').val(response.Mc2_2);
$('#modal-form2 [name=T1_2]').val(response.T1_2);
$('#modal-form2 [name=T2_2]').val(response.T2_2);
$('#modal-form2 [name=T3_2]').val(response.T3_2);
$('#modal-form2 [name=T4_2]').val(response.T4_2);
$('#modal-form2 [name=Tc1_2]').val(response.Tc1_2);
$('#modal-form2 [name=Tc2_2]').val(response.Tc2_2);
$('#modal-form2 [name=Tc3_2]').val(response.Tc3_2);
$('#modal-form2 [name=Tc4_2]').val(response.Tc4_2);


                $('#modal-form2 [name=nama_dmu3]').val(response.nama_dmu3);
                $('#modal-form2 [name=M1_3]').val(response.M1_3);
$('#modal-form2 [name=M2_3]').val(response.M2_3);
$('#modal-form2 [name=Mc1_3]').val(response.Mc1_3);
$('#modal-form2 [name=Mc2_3]').val(response.Mc2_3);
$('#modal-form2 [name=T1_3]').val(response.T1_3);
$('#modal-form2 [name=T2_3]').val(response.T2_3);
$('#modal-form2 [name=T3_3]').val(response.T3_3);
$('#modal-form2 [name=T4_3]').val(response.T4_3);
$('#modal-form2 [name=Tc1_3]').val(response.Tc1_3);
$('#modal-form2 [name=Tc2_3]').val(response.Tc2_3);
$('#modal-form2 [name=Tc3_3]').val(response.Tc3_3);
$('#modal-form2 [name=Tc4_3]').val(response.Tc4_3);


                $('#modal-form2 [name=nama_dmu4]').val(response.nama_dmu4);
                $('#modal-form2 [name=M1_4]').val(response.M1_4);
$('#modal-form2 [name=M2_4]').val(response.M2_4);
$('#modal-form2 [name=Mc1_4]').val(response.Mc1_4);
$('#modal-form2 [name=Mc2_4]').val(response.Mc2_4);
$('#modal-form2 [name=T1_4]').val(response.T1_4);
$('#modal-form2 [name=T2_4]').val(response.T2_4);
$('#modal-form2 [name=T3_4]').val(response.T3_4);
$('#modal-form2 [name=T4_4]').val(response.T4_4);
$('#modal-form2 [name=Tc1_4]').val(response.Tc1_4);
$('#modal-form2 [name=Tc2_4]').val(response.Tc2_4);
$('#modal-form2 [name=Tc3_4]').val(response.Tc3_4);
$('#modal-form2 [name=Tc4_4]').val(response.Tc4_4);


                $('#modal-form2 [name=nama_dmu5]').val(response.nama_dmu5);
                $('#modal-form2 [name=M1_5]').val(response.M1_5);
$('#modal-form2 [name=M2_5]').val(response.M2_5);
$('#modal-form2 [name=Mc1_5]').val(response.Mc1_5);
$('#modal-form2 [name=Mc2_5]').val(response.Mc2_5);
$('#modal-form2 [name=T1_5]').val(response.T1_5);
$('#modal-form2 [name=T2_5]').val(response.T2_5);
$('#modal-form2 [name=T3_5]').val(response.T3_5);
$('#modal-form2 [name=T4_5]').val(response.T4_5);
$('#modal-form2 [name=Tc1_5]').val(response.Tc1_5);
$('#modal-form2 [name=Tc2_5]').val(response.Tc2_5);
$('#modal-form2 [name=Tc3_5]').val(response.Tc3_5);
$('#modal-form2 [name=Tc4_5]').val(response.Tc4_5);


                $('#modal-form2 [name=nama_dmu6]').val(response.nama_dmu6);
                $('#modal-form2 [name=M1_6]').val(response.M1_6);
$('#modal-form2 [name=M2_6]').val(response.M2_6);
$('#modal-form2 [name=Mc1_6]').val(response.Mc1_6);
$('#modal-form2 [name=Mc2_6]').val(response.Mc2_6);
$('#modal-form2 [name=T1_6]').val(response.T1_6);
$('#modal-form2 [name=T2_6]').val(response.T2_6);
$('#modal-form2 [name=T3_6]').val(response.T3_6);
$('#modal-form2 [name=T4_6]').val(response.T4_6);
$('#modal-form2 [name=Tc1_6]').val(response.Tc1_6);
$('#modal-form2 [name=Tc2_6]').val(response.Tc2_6);
$('#modal-form2 [name=Tc3_6]').val(response.Tc3_6);
$('#modal-form2 [name=Tc4_6]').val(response.Tc4_6);


                $('#modal-form2 [name=nama_dmu7]').val(response.nama_dmu7);
                $('#modal-form2 [name=M1_7]').val(response.M1_7);
$('#modal-form2 [name=M2_7]').val(response.M2_7);
$('#modal-form2 [name=Mc1_7]').val(response.Mc1_7);
$('#modal-form2 [name=Mc2_7]').val(response.Mc2_7);
$('#modal-form2 [name=T1_7]').val(response.T1_7);
$('#modal-form2 [name=T2_7]').val(response.T2_7);
$('#modal-form2 [name=T3_7]').val(response.T3_7);
$('#modal-form2 [name=T4_7]').val(response.T4_7);
$('#modal-form2 [name=Tc1_7]').val(response.Tc1_7);
$('#modal-form2 [name=Tc2_7]').val(response.Tc2_7);
$('#modal-form2 [name=Tc3_7]').val(response.Tc3_7);
$('#modal-form2 [name=Tc4_7]').val(response.Tc4_7);


                $('#modal-form2 [name=nama_dmu8]').val(response.nama_dmu8);
                $('#modal-form2 [name=M1_8]').val(response.M1_8);
$('#modal-form2 [name=M2_8]').val(response.M2_8);
$('#modal-form2 [name=Mc1_8]').val(response.Mc1_8);
$('#modal-form2 [name=Mc2_8]').val(response.Mc2_8);
$('#modal-form2 [name=T1_8]').val(response.T1_8);
$('#modal-form2 [name=T2_8]').val(response.T2_8);
$('#modal-form2 [name=T3_8]').val(response.T3_8);
$('#modal-form2 [name=T4_8]').val(response.T4_8);
$('#modal-form2 [name=Tc1_8]').val(response.Tc1_8);
$('#modal-form2 [name=Tc2_8]').val(response.Tc2_8);
$('#modal-form2 [name=Tc3_8]').val(response.Tc3_8);
$('#modal-form2 [name=Tc4_8]').val(response.Tc4_8);


                $('#modal-form2 [name=nama_dmu9]').val(response.nama_dmu9);
                $('#modal-form2 [name=M1_9]').val(response.M1_9);
$('#modal-form2 [name=M2_9]').val(response.M2_9);
$('#modal-form2 [name=Mc1_9]').val(response.Mc1_9);
$('#modal-form2 [name=Mc2_9]').val(response.Mc2_9);
$('#modal-form2 [name=T1_9]').val(response.T1_9);
$('#modal-form2 [name=T2_9]').val(response.T2_9);
$('#modal-form2 [name=T3_9]').val(response.T3_9);
$('#modal-form2 [name=T4_9]').val(response.T4_9);
$('#modal-form2 [name=Tc1_9]').val(response.Tc1_9);
$('#modal-form2 [name=Tc2_9]').val(response.Tc2_9);
$('#modal-form2 [name=Tc3_9]').val(response.Tc3_9);
$('#modal-form2 [name=Tc4_9]').val(response.Tc4_9);


                $('#modal-form2 [name=nama_dmu10]').val(response.nama_dmu10);
                $('#modal-form2 [name=M1_10]').val(response.M1_10);
$('#modal-form2 [name=M2_10]').val(response.M2_10);
$('#modal-form2 [name=Mc1_10]').val(response.Mc1_10);
$('#modal-form2 [name=Mc2_10]').val(response.Mc2_10);
$('#modal-form2 [name=T1_10]').val(response.T1_10);
$('#modal-form2 [name=T2_10]').val(response.T2_10);
$('#modal-form2 [name=T3_10]').val(response.T3_10);
$('#modal-form2 [name=T4_10]').val(response.T4_10);
$('#modal-form2 [name=Tc1_10]').val(response.Tc1_10);
$('#modal-form2 [name=Tc2_10]').val(response.Tc2_10);
$('#modal-form2 [name=Tc3_10]').val(response.Tc3_10);
$('#modal-form2 [name=Tc4_10]').val(response.Tc4_10);


                $('#modal-form2 [name=nama_dmu11]').val(response.nama_dmu11);
                $('#modal-form2 [name=M1_11]').val(response.M1_11);
$('#modal-form2 [name=M2_11]').val(response.M2_11);
$('#modal-form2 [name=Mc1_11]').val(response.Mc1_11);
$('#modal-form2 [name=Mc2_11]').val(response.Mc2_11);
$('#modal-form2 [name=T1_11]').val(response.T1_11);
$('#modal-form2 [name=T2_11]').val(response.T2_11);
$('#modal-form2 [name=T3_11]').val(response.T3_11);
$('#modal-form2 [name=T4_11]').val(response.T4_11);
$('#modal-form2 [name=Tc1_11]').val(response.Tc1_11);
$('#modal-form2 [name=Tc2_11]').val(response.Tc2_11);
$('#modal-form2 [name=Tc3_11]').val(response.Tc3_11);
$('#modal-form2 [name=Tc4_11]').val(response.Tc4_11);


                $('#modal-form2 [name=nama_dmu12]').val(response.nama_dmu12);
                $('#modal-form2 [name=M1_12]').val(response.M1_12);
$('#modal-form2 [name=M2_12]').val(response.M2_12);
$('#modal-form2 [name=Mc1_12]').val(response.Mc1_12);
$('#modal-form2 [name=Mc2_12]').val(response.Mc2_12);
$('#modal-form2 [name=T1_12]').val(response.T1_12);
$('#modal-form2 [name=T2_12]').val(response.T2_12);
$('#modal-form2 [name=T3_12]').val(response.T3_12);
$('#modal-form2 [name=T4_12]').val(response.T4_12);
$('#modal-form2 [name=Tc1_12]').val(response.Tc1_12);
$('#modal-form2 [name=Tc2_12]').val(response.Tc2_12);
$('#modal-form2 [name=Tc3_12]').val(response.Tc3_12);
$('#modal-form2 [name=Tc4_12]').val(response.Tc4_12);


                $('#modal-form2 [name=nama_dmu13]').val(response.nama_dmu13);
                $('#modal-form2 [name=M1_13]').val(response.M1_13);
$('#modal-form2 [name=M2_13]').val(response.M2_13);
$('#modal-form2 [name=Mc1_13]').val(response.Mc1_13);
$('#modal-form2 [name=Mc2_13]').val(response.Mc2_13);
$('#modal-form2 [name=T1_13]').val(response.T1_13);
$('#modal-form2 [name=T2_13]').val(response.T2_13);
$('#modal-form2 [name=T3_13]').val(response.T3_13);
$('#modal-form2 [name=T4_13]').val(response.T4_13);
$('#modal-form2 [name=Tc1_13]').val(response.Tc1_13);
$('#modal-form2 [name=Tc2_13]').val(response.Tc2_13);
$('#modal-form2 [name=Tc3_13]').val(response.Tc3_13);
$('#modal-form2 [name=Tc4_13]').val(response.Tc4_13);


                $('#modal-form2 [name=nama_dmu14]').val(response.nama_dmu14);
                $('#modal-form2 [name=M1_14]').val(response.M1_14);
$('#modal-form2 [name=M2_14]').val(response.M2_14);
$('#modal-form2 [name=Mc1_14]').val(response.Mc1_14);
$('#modal-form2 [name=Mc2_14]').val(response.Mc2_14);
$('#modal-form2 [name=T1_14]').val(response.T1_14);
$('#modal-form2 [name=T2_14]').val(response.T2_14);
$('#modal-form2 [name=T3_14]').val(response.T3_14);
$('#modal-form2 [name=T4_14]').val(response.T4_14);
$('#modal-form2 [name=Tc1_14]').val(response.Tc1_14);
$('#modal-form2 [name=Tc2_14]').val(response.Tc2_14);
$('#modal-form2 [name=Tc3_14]').val(response.Tc3_14);
$('#modal-form2 [name=Tc4_14]').val(response.Tc4_14);


                $('#modal-form2 [name=nama_dmu15]').val(response.nama_dmu15);
                $('#modal-form2 [name=M1_15]').val(response.M1_15);
$('#modal-form2 [name=M2_15]').val(response.M2_15);
$('#modal-form2 [name=Mc1_15]').val(response.Mc1_15);
$('#modal-form2 [name=Mc2_15]').val(response.Mc2_15);
$('#modal-form2 [name=T1_15]').val(response.T1_15);
$('#modal-form2 [name=T2_15]').val(response.T2_15);
$('#modal-form2 [name=T3_15]').val(response.T3_15);
$('#modal-form2 [name=T4_15]').val(response.T4_15);
$('#modal-form2 [name=Tc1_15]').val(response.Tc1_15);
$('#modal-form2 [name=Tc2_15]').val(response.Tc2_15);
$('#modal-form2 [name=Tc3_15]').val(response.Tc3_15);
$('#modal-form2 [name=Tc4_15]').val(response.Tc4_15);

$('#modal-form2 [name=p1]').val(response.p1);
$('#modal-form2 [name=p2]').val(response.p2);
$('#modal-form2 [name=p3]').val(response.p3);
$('#modal-form2 [name=p4]').val(response.p4);
$('#modal-form2 [name=p5]').val(response.p5);
$('#modal-form2 [name=p6]').val(response.p6);
$('#modal-form2 [name=p7]').val(response.p7);
$('#modal-form2 [name=p8]').val(response.p8);
$('#modal-form2 [name=p9]').val(response.p9);
$('#modal-form2 [name=p10]').val(response.p10);
$('#modal-form2 [name=p11]').val(response.p11);
$('#modal-form2 [name=p12]').val(response.p12);
$('#modal-form2 [name=p13]').val(response.p13);
$('#modal-form2 [name=p14]').val(response.p14);

            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }