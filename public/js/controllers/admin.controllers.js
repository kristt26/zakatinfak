angular
  .module("adminctrl", [])
  // Admin
  .controller("dashboardController", dashboardController)
  .controller("petugasController", petugasController)
  .controller("muzakiMustahikController", muzakiMustahikController)
  .controller("jenisBantuanController", jenisBantuanController)
  .controller("persyaratanController", persyaratanController)
  .controller("kategoriZisController", kategoriZisController)
  .controller("kriteriaController", kriteriaController)
  .controller("subKriteriaController", subKriteriaController)
  .controller("pertanyaanController", pertanyaanController)
  .controller("surveyController", surveyController)
  .controller("biodataController", biodataController)
  .controller("biodataMuzakiController", biodataMuzakiController)
  .controller("pengajuanController", pengajuanController)
  .controller("daftarPengajuanController", daftarPengajuanController)
  .controller("pembayaranController", pembayaranController)
  .controller("daftarPembayaranController", daftarPembayaranController)
  .controller("laporanPembayaranController", laporanPembayaranController)
  .controller("laporanBantuanController", laporanBantuanController)
  .controller("pembayaranMustahikController", pembayaranMustahikController)
  ;

function dashboardController($scope, dashboardServices) {
  $scope.$emit("SendUp", "Beranda");
  $scope.datas = {};
  $scope.title = "Beranda";
}

function petugasController($scope, petugasServices, pesan) {
  $scope.$emit("SendUp", "Manajemen Petugas");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  petugasServices.get().then((res) => {
    $scope.datas = res;
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          petugasServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          petugasServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        petugasServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function muzakiMustahikController($scope, muzakiMustahikServices, pesan) {
  $scope.$emit("SendUp", "Daftar Akun Muzaki dan Mustahik");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  muzakiMustahikServices.get().then((res) => {
    $scope.datas = res;
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          muzakiMustahikServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          muzakiMustahikServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        muzakiMustahikServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function jenisBantuanController($scope, jenisBantuanServices, pesan) {
  $scope.$emit("SendUp", "Jenis Bantuan");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  jenisBantuanServices.get().then((res) => {
    $scope.datas = res;
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          jenisBantuanServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          jenisBantuanServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        jenisBantuanServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function persyaratanController(
  $scope,
  helperServices,
  persyaratanServices,
  pesan
) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  persyaratanServices.get(helperServices.lastPath).then((res) => {
    $scope.datas = res;
    $scope.$emit("SendUp", "Persyaratan " + res[0].nama_bantuan);
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          $scope.model.id_jenis_bantuan = helperServices.lastPath;
          persyaratanServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          persyaratanServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        persyaratanServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function kategoriZisController($scope, kategoriServices, pesan) {
  $scope.$emit("SendUp", "Kategori ZIS");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  kategoriServices.get().then((res) => {
    $scope.datas = res;
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          kategoriServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          kategoriServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        kategoriServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function kriteriaController($scope, kriteriaServices, pesan) {
  $scope.$emit("SendUp", "Kriteria Survey");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  kriteriaServices.get().then((res) => {
    $scope.datas = res;
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          kriteriaServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          kriteriaServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        kriteriaServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function subKriteriaController(
  $scope,
  helperServices,
  subKriteriaServices,
  pesan
) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  subKriteriaServices.get(helperServices.lastPath).then((res) => {
    $scope.datas = res;
    $scope.$emit("SendUp", "Sub Kriteria  " + res[0].nama_kriteria);
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          $scope.model.id_kriteria = helperServices.lastPath;
          subKriteriaServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          subKriteriaServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        subKriteriaServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function pertanyaanController(
  $scope,
  helperServices,
  pertanyaanServices,
  pesan
) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  pertanyaanServices.get(helperServices.lastPath).then((res) => {
    $scope.datas = res;
    $scope.$emit("SendUp", "Pertanyaan Sub Kriteria  " + res[0].nama_sub);
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          $scope.model.id_sub_kriteria = helperServices.lastPath;
          pertanyaanServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          pertanyaanServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        pertanyaanServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function surveyController($scope, helperServices, surveyServices, pesan) {
  $scope.$emit("SendUp", "Form Survey Mustahik");

  $scope.totalPertanyaan = 0;
  $scope.idPendaftaran = helperServices.lastPath;
  $scope.datas = { kriteria: [] };

  // Load data survey
  surveyServices.get($scope.idPendaftaran).then((res) => {
    $scope.datas = res;

    // Hitung total pertanyaan
    let total = 0;
    angular.forEach(res.kriteria, (k) => {
      angular.forEach(k.subKriteria, (s) => {
        total += s.pertanyaan.length;
      });
    });
    angular.forEach($scope.datas.kriteria, (k) => {
      angular.forEach(k.subKriteria, (s) => {
        angular.forEach(s.pertanyaan, (q) => {
          if (res.survey.length == 0) {
            if (q.jawaban === undefined || q.jawaban === null) {
              if (q.type === "checkbox") {
                q.jawaban = []; // array kosong
              } else if (q.type === "radio") {
                q.jawaban = null; // radio/number string kosong
              }
            }
          } else {
            if (q.type === "number") {
              q.jawaban = parseFloat(q.jawaban);
            }
          }
        });
      });
    });

    console.log(res);
    $scope.totalPertanyaan = total;
  });

  // Hitung jumlah jawaban terisi (untuk progress bar)
  $scope.getTotalJawaban = function () {
    let count = 0;
    angular.forEach($scope.datas.kriteria, (k) => {
      angular.forEach(k.subKriteria, (s) => {
        angular.forEach(s.pertanyaan, (q) => {
          if (q.type === "checkbox") {
            if (q.jawaban && q.jawaban.length > 0) count++;
          } else if (q.jawaban) {
            count++;
          }
        });
      });
    });
    return count;
  };

  // Handler untuk checkbox
  $scope.toggleCheckbox = function (q, label) {
    if (!q.jawaban) q.jawaban = [];
    let idx = q.jawaban.indexOf(label);
    if (idx > -1) {
      q.jawaban.splice(idx, 1);
    } else {
      q.jawaban.push(label); // ✅ simpan label, bukan skor
    }
  };

  // Ambil semua jawaban untuk payload
  function collectPayload(isUpdate = false) {
    let payload = [];

    // buat peta survey lama
    let surveyMap = {};
    if ($scope.datas && $scope.datas.survey) {
      $scope.datas.survey.forEach((s) => {
        let key = s.id_pertanyaan + "|" + (s.jawaban ?? "");
        surveyMap[key] = s.id;
      });
    }

    console.log("SurveyMap:", surveyMap);

    // simpan semua key baru yang dipilih user
    let newKeys = new Set();

    angular.forEach($scope.datas.kriteria, (k) => {
      angular.forEach(k.subKriteria, (s) => {
        angular.forEach(s.pertanyaan, (q) => {
          if (q.type === "checkbox") {
            (q.jawaban || []).forEach((label) => {
              let key = q.id + "|" + label;
              newKeys.add(key);

              let oldId = isUpdate ? surveyMap[key] || null : null;
              payload.push({
                id: oldId,
                id_pendaftaran: $scope.idPendaftaran,
                id_pertanyaan: q.id,
                jawaban: label,
                status_verifikasi: null,
                isDeleted: false, // default
              });
            });
          } else if (
            q.jawaban !== undefined &&
            q.jawaban !== null &&
            q.jawaban !== ""
          ) {
            let key = q.id + "|" + q.jawaban;
            newKeys.add(key);

            let oldId = isUpdate ? surveyMap[key] || null : null;
            payload.push({
              id: oldId,
              id_pendaftaran: $scope.idPendaftaran,
              id_pertanyaan: q.id,
              jawaban: q.jawaban,
              status_verifikasi: null,
              isDeleted: false,
            });
          }
        });
      });
    });

    // cek jawaban lama yang hilang (khusus kalau update)
    if (isUpdate) {
      Object.keys(surveyMap).forEach((oldKey) => {
        if (!newKeys.has(oldKey)) {
          // jawaban lama tidak ada di jawaban baru → tandai sebagai deleted
          payload.push({
            id: surveyMap[oldKey],
            id_pendaftaran: $scope.idPendaftaran,
            id_pertanyaan: parseInt(oldKey.split("|")[0], 10),
            jawaban: oldKey.split("|")[1] || null,
            status_verifikasi: null,
            isDeleted: true,
          });
        }
      });
    }

    console.log("Payload Result:", payload);
    return payload;
  }

  // Submit jawaban baru
  $scope.submitSurvey = function () {
    let payload = collectPayload(false);
    console.log(payload);

    surveyServices.post(payload).then(() => {
      pesan
        .dialog("Data berhasil disimpan", "OK", false, "success")
        .then(() => history.back());
    });
  };

  // Update jawaban lama
  $scope.updateSurvey = function () {
    let payload = collectPayload(true);
    surveyServices.put(payload).then(() => {
      pesan
        .dialog("Data berhasil diupdate", "OK", false, "success")
        .then(() => history.back());
    });
  };
}

function biodataController($scope, biodataServices, pesan) {
  $scope.$emit("SendUp", "Biodata");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  biodataServices.get().then((res) => {
    $scope.model = res;
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        biodataServices.put($scope.model).then((res) => {
          pesan.Success("Data berhasil disimpan", "Success", "info");
        });
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };
}

function biodataMuzakiController($scope, biodataMuzakiServices, pesan) {
  $scope.$emit("SendUp", "Biodata");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  biodataMuzakiServices.get().then((res) => {
    $scope.model = res;
    console.log(res);
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        biodataMuzakiServices.put($scope.model).then((res) => {
          pesan.Success("Data berhasil disimpan", "Success", "info");
        });
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };
}

function pengajuanController($scope, helperServices, pengajuanServices, pesan) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  if (helperServices.lastPath == "pengajuan") {
    $scope.$emit("SendUp", "Daftar Pengajuan");
    pengajuanServices.get().then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  } else if (helperServices.lastPath == "tambah_pengajuan") {
    $scope.$emit("SendUp", "Tambah Pengajuan");
    $scope.model.no_daftar = helperServices.randomString("PEN");
    pengajuanServices.getAdd().then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  } else {
    $scope.$emit("SendUp", "Ubah Pengajuan");
    // $scope.model.no_daftar = helperServices.randomString();
    pengajuanServices.getEdit(helperServices.lastPath).then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  }

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        $scope.model.kelengkapan = $scope.bantuan.persyaratan;
        pengajuanServices.post($scope.model).then((res) => {
          $scope.model = {};
          pesan
            .dialog("Data berhasil disimpan", "OK", false, "success")
            .then((x) => {
              history.back();
            });
        });
      });
  };

  $scope.update = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        var item = {
          id: $scope.datas.pengajuan.id,
          persyaratan: $scope.datas.bantuan.persyaratan,
        };
        pengajuanServices.put(item).then((res) => {
          $scope.model = {};
          pesan
            .dialog("Data berhasil disimpan", "OK", false, "success")
            .then((x) => {
              history.back();
            });
        });
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.showRekom = (param) => {
    $scope.rekom = param;
    $("#modelId").modal("show");
  };
}

function daftarPengajuanController(
  $scope,
  helperServices,
  daftarPengajuanServices,
  pesan
) {
  
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  if (helperServices.lastPath == "pendaftaran") {
    $scope.$emit("SendUp", "Daftar Pengajuan Bantuan");
    daftarPengajuanServices.get().then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  } else {
    $scope.$emit("SendUp", "Validasi Pengajuan");
    daftarPengajuanServices.getDetail(helperServices.lastPath).then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  }
  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          daftarPengajuanServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          daftarPengajuanServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.update = (param) => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (param == "diverifikasi") {
          $scope.datas.pengajuan.status_pengajuan = param;
        } else {
          $("#modelId").modal("hide");
        }
        daftarPengajuanServices.put($scope.datas.pengajuan).then((res) => {
          pesan
            .dialog("Data berhasil disimpan", "OK", false, "success")
            .then((x) => {
              history.back();
            });
        });
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        daftarPengajuanServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function pembayaranController(
  $scope,
  helperServices,
  pembayaranServices,
  pesan
) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  if (helperServices.lastPath == "pembayaran") {
    $scope.$emit("SendUp", "Daftar Pembayaran");
    pembayaranServices.get().then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  } else if (helperServices.lastPath == "tambah_pembayaran") {
    $scope.$emit("SendUp", "Tambah Pembayaran");
    $scope.model.no_bayar = helperServices.randomString("BYR");
    pembayaranServices.getAdd().then((res) => {
      $scope.datas = res;
      $scope.model.jumlah_bayar =
        parseFloat($scope.datas.biodata.penghasilan) * 0.025;
      console.log(res);
    });
  } else {
    $scope.$emit("SendUp", "Ubah Pembayaran");
    // $scope.model.no_daftar = helperServices.randomString();
    pembayaranServices.getEdit(helperServices.lastPath).then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  }

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        pembayaranServices.post($scope.model).then((res) => {
          $scope.model = {};
          pesan
            .dialog("Data berhasil disimpan", "OK", false, "success")
            .then((x) => {
              history.back();
            });
        });
      });
  };

  $scope.update = () => {
    pesan.dialog("Apakah anda yakin?", "Ya", "Tidak", "info").then((res) => {
      pembayaranServices.put($scope.model).then((res) => {
        pesan.Success("Proses Berhasil");
        $("#modelId").modal("hide");
      });
    });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.showRekom = (param) => {
    $scope.rekom = param;
    $("#modelId").modal("show");
  };
}

function pembayaranMustahikController(
  $scope,
  helperServices,
  pembayaranMustahikServices,
  pesan
) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  if (helperServices.lastPath == "pembayaran") {
    $scope.$emit("SendUp", "Daftar Pembayaran");
    pembayaranMustahikServices.get().then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  } else if (helperServices.lastPath == "tambah_pembayaran") {
    $scope.$emit("SendUp", "Tambah Pembayaran");
    $scope.model.no_bayar = helperServices.randomString("BYR");
    pembayaranMustahikServices.getAdd().then((res) => {
      $scope.datas = res;
      $scope.model.jumlah_bayar =
        parseFloat($scope.datas.biodata.penghasilan) * 0.025;
      console.log(res);
    });
  } else {
    $scope.$emit("SendUp", "Ubah Pembayaran");
    // $scope.model.no_daftar = helperServices.randomString();
    pembayaranMustahikServices.getEdit(helperServices.lastPath).then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  }

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        pembayaranMustahikServices.post($scope.model).then((res) => {
          $scope.model = {};
          pesan
            .dialog("Data berhasil disimpan", "OK", false, "success")
            .then((x) => {
              history.back();
            });
        });
      });
  };

  $scope.update = () => {
    pesan.dialog("Apakah anda yakin?", "Ya", "Tidak", "info").then((res) => {
      pembayaranMustahikServices.put($scope.model).then((res) => {
        pesan.Success("Proses Berhasil");
        $("#modelId").modal("hide");
      });
    });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.showRekom = (param) => {
    $scope.rekom = param;
    $("#modelId").modal("show");
  };
}

function daftarPembayaranController(
  $scope,
  helperServices,
  daftarPembayaranServices,
  pesan
) {
  $scope.$emit("SendUp", "Daftar Pembayaran");
  $scope.datas = [];
  $scope.model = {};
  $scope.tampil = "produk";
  if (helperServices.lastPath == "pembayaran") {
    daftarPembayaranServices.get().then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  } else {
    daftarPembayaranServices.getDetail(helperServices.lastPath).then((res) => {
      $scope.datas = res;
      console.log(res);
    });
  }
  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id) {
          daftarPembayaranServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          daftarPembayaranServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.update = (param, id) => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (param == "valid") {
          $scope.model.status_transaksi = param;
          $scope.model.id = id;
        } else {
          $("#modelId").modal("hide");
          $scope.model.status_transaksi = param;
        }
        daftarPembayaranServices.put($scope.model).then((res) => {
          pesan
            .dialog("Data berhasil disimpan", "OK", false, "success")
            .then((x) => {
              pesan.Success("Berhasi menyimpan data");
            });
        });
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        daftarPembayaranServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function laporanPembayaranController(
  $scope,
  pesan,
  $timeout,
  helperServices,
  $http
) {
  $scope.$emit("SendUp", "Laporan Pembayaran ZIS");
  $scope.filter = {
    tipePeriode: "range", // default tipe periode
    tanggal_range: "",
    dari_tanggal: "",
    sampai_tanggal: "",
    bulan_tahun: "",
    tahun: "",
    status: "",
    metode_bayar: "",
  };

  $scope.laporan = [];

  // Reset semua filter tanggal saat tipe periode berganti
  $scope.resetTanggal = function () {
    $scope.filter.tanggal_range = "";
    $scope.filter.dari_tanggal = "";
    $scope.filter.sampai_tanggal = "";
    $scope.filter.bulan_tahun = "";
    $scope.filter.tahun = "";
    $scope.laporan = [];

    if ($scope.filter.tipePeriode === "range") {
      $timeout(function () {
        $scope.initDateRangePicker();
      }, 0);
    }
  };

  $scope.initDateRangePicker = () => {
    var picker = $("#tanggalRange").data("daterangepicker");
    if (picker) {
      picker.remove();
      $("#tanggalRange").off(); // hapus event sebelumnya
    }

    $("#tanggalRange").daterangepicker(
      {
        autoUpdateInput: false,
        locale: {
          format: "YYYY-MM-DD",
          separator: " s.d. ",
          applyLabel: "Terapkan",
          cancelLabel: "Batal",
          fromLabel: "Dari",
          toLabel: "Sampai",
          customRangeLabel: "Kustom",
          daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
          monthNames: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
          ],
          firstDay: 1,
        },
      },
      function (start, end) {
        $scope.filter.dari_tanggal = start.format("YYYY-MM-DD");
        $scope.filter.sampai_tanggal = end.format("YYYY-MM-DD");
        $scope.filter.tanggal_range =
          start.format("YYYY-MM-DD") + " s.d. " + end.format("YYYY-MM-DD");

        $("#tanggalRange").val($scope.filter.tanggal_range);

        // 🔥 Panggil filterLaporan() manual
        $scope.filterLaporan();

        $scope.$apply();
      }
    );

    $("#tanggalRange").on("cancel.daterangepicker", function (ev, picker) {
      $(this).val("");
      $scope.filter.tanggal_range = "";
      $scope.filter.dari_tanggal = "";
      $scope.filter.sampai_tanggal = "";
      $scope.$apply();
    });
  };

  // Inisialisasi daterangepicker hanya untuk tipePeriode == 'range'
  $timeout(function () {
    if ($scope.filter.tipePeriode === "range") {
      $scope.initDateRangePicker();
    }
  }, 100);

  $scope.filterLaporan = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        alert("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      $scope.filter.dari_tanggal = range[0];
      $scope.filter.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      $scope.filter.dari_tanggal = `${tahun}-${bulan}-01`;
      $scope.filter.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      $scope.filter.dari_tanggal = `${tahun}-01-01`;
      $scope.filter.sampai_tanggal = `${tahun}-12-31`;
    }

    $http({
      method: "POST",
      url: helperServices.url + "laporan/pembayaran/data",
      data: $scope.filter,
    }).then(
      function (response) {
        $scope.laporan = response.data;
        $scope.totalPembayaran = $scope.laporan.reduce((acc, item) => {
          return acc + (parseFloat(item.jumlah_bayar) || 0);
        }, 0);
        console.log(response.data);
      },
      function (error) {
        pesan.Error("Gagal mengambil data laporan");
        console.error(error);
      }
    );
  };

  $scope.downloadExcel = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      params.dari_tanggal = `${tahun}-01-01`;
      params.sampai_tanggal = `${tahun}-12-31`;
    }

    var queryString = new URLSearchParams(params).toString();
    window.open("/laporan/pembayaran/excel?" + queryString, "_blank");
  };

  $scope.cetak = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      params.dari_tanggal = `${tahun}-01-01`;
      params.sampai_tanggal = `${tahun}-12-31`;
    }

    var queryString = new URLSearchParams(params).toString();
    window.open("/laporan/pembayaran/print?" + queryString, "_blank");
  };
}

function laporanBantuanController(
  $scope,
  pesan,
  $timeout,
  helperServices,
  $http
) {
  $scope.$emit("SendUp", "Laporan Penerima Manfaat");
  $scope.filter = {
    tipePeriode: "range", // default tipe periode
    tanggal_range: "",
    dari_tanggal: "",
    sampai_tanggal: "",
    bulan_tahun: "",
    tahun: "",
    status: "",
    metode_bayar: "",
  };

  $scope.laporan = [];

  // Reset semua filter tanggal saat tipe periode berganti
  $scope.resetTanggal = function () {
    $scope.filter.tanggal_range = "";
    $scope.filter.dari_tanggal = "";
    $scope.filter.sampai_tanggal = "";
    $scope.filter.bulan_tahun = "";
    $scope.filter.tahun = "";
    $scope.laporan = [];

    if ($scope.filter.tipePeriode === "range") {
      $timeout(function () {
        $scope.initDateRangePicker();
      }, 0);
    }
  };

  $scope.initDateRangePicker = () => {
    var picker = $("#tanggalRange").data("daterangepicker");
    if (picker) {
      picker.remove();
      $("#tanggalRange").off(); // hapus event sebelumnya
    }

    $("#tanggalRange").daterangepicker(
      {
        autoUpdateInput: false,
        locale: {
          format: "YYYY-MM-DD",
          separator: " s.d. ",
          applyLabel: "Terapkan",
          cancelLabel: "Batal",
          fromLabel: "Dari",
          toLabel: "Sampai",
          customRangeLabel: "Kustom",
          daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
          monthNames: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
          ],
          firstDay: 1,
        },
      },
      function (start, end) {
        $scope.filter.dari_tanggal = start.format("YYYY-MM-DD");
        $scope.filter.sampai_tanggal = end.format("YYYY-MM-DD");
        $scope.filter.tanggal_range =
          start.format("YYYY-MM-DD") + " s.d. " + end.format("YYYY-MM-DD");

        $("#tanggalRange").val($scope.filter.tanggal_range);

        // 🔥 Panggil filterLaporan() manual
        $scope.filterLaporan();

        $scope.$apply();
      }
    );

    $("#tanggalRange").on("cancel.daterangepicker", function (ev, picker) {
      $(this).val("");
      $scope.filter.tanggal_range = "";
      $scope.filter.dari_tanggal = "";
      $scope.filter.sampai_tanggal = "";
      $scope.$apply();
    });
  };

  // Inisialisasi daterangepicker hanya untuk tipePeriode == 'range'
  $timeout(function () {
    if ($scope.filter.tipePeriode === "range") {
      $scope.initDateRangePicker();
    }
  }, 100);

  $scope.filterLaporan = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        alert("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      $scope.filter.dari_tanggal = range[0];
      $scope.filter.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      $scope.filter.dari_tanggal = `${tahun}-${bulan}-01`;
      $scope.filter.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      $scope.filter.dari_tanggal = `${tahun}-01-01`;
      $scope.filter.sampai_tanggal = `${tahun}-12-31`;
    }

    $http({
      method: "POST",
      url: helperServices.url + "laporan/bantuan/data",
      data: $scope.filter,
    }).then(
      function (response) {
        $scope.laporan = response.data;
        console.log(response.data);
      },
      function (error) {
        pesan.Error("Gagal mengambil data laporan");
        console.error(error);
      }
    );
  };

  $scope.downloadExcel = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      params.dari_tanggal = `${tahun}-01-01`;
      params.sampai_tanggal = `${tahun}-12-31`;
    }

    var queryString = new URLSearchParams(params).toString();
    window.open("/laporan/bantuan/excel?" + queryString, "_blank");
  };

  $scope.cetak = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      params.dari_tanggal = `${tahun}-01-01`;
      params.sampai_tanggal = `${tahun}-12-31`;
    }

    var queryString = new URLSearchParams(params).toString();
    window.open("/laporan/bantuan/print?" + queryString, "_blank");
  };
}
