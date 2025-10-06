<?= $this->extend('layout/admin/indeks') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center" ng-controller="surveyController">
    <div class="col-lg-10">
        <form ng-submit="submitSurvey()" class="p-4 bg-white shadow-lg rounded-3">

            <!-- Header -->
            <div class="text-center mb-5">
                <div class="mb-3">
                    <i class="fas fa-poll-h fa-3x text-primary"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1">Survey Mustahik</h3>
                <p class="text-muted">Jawablah setiap pertanyaan dengan jujur untuk hasil yang lebih akurat</p>
            </div>

            <!-- Progress Indicator -->
            <div class="progress mb-4" style="height: 8px;">
                <div class="progress-bar bg-primary" role="progressbar" 
                     style="width: {{(Object.keys(jawaban).length / totalPertanyaan) * 100}}%" 
                     aria-valuenow="{{(Object.keys(jawaban).length / totalPertanyaan) * 100}}" 
                     aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>

            <!-- Loop Kriteria -->
            <div ng-repeat="k in datas.kriteria" class="mb-5">
                <h4 class="fw-bold text-primary mb-3">
                    <i class="fas fa-layer-group me-2"></i> {{k.nama_kriteria}}
                    <small class="text-muted">(Bobot: {{k.bobot}}%)</small>
                </h4>

                <!-- Loop Sub Kriteria -->
                <div ng-repeat="s in k.subKriteria" class="ms-3 mb-4">
                    <h5 class="fw-semibold text-dark mb-3">
                        <i class="fas fa-angle-right text-secondary me-2"></i> {{s.nama_sub}}
                    </h5>

                    <!-- Pertanyaan untuk subkriteria ini -->
                    <div class="card border-0 shadow-sm mb-3 rounded-3" ng-repeat="q in s.pertanyaan">
                        <div class="card-body">
                            <label class="fw-semibold text-dark mb-3 d-block fs-6">
                                <i class="fas fa-question-circle text-primary me-2"></i> {{q.pertanyaan}}
                            </label>

                            <!-- RADIO -->
                            <div ng-if="q.type == 'radio'" class="ps-2">
                                <div class="form-check mb-2" ng-repeat="ops in q.opsi track by $index">
                                    <input class="form-check-input" type="radio"
                                           id="radio_{{q.id}}_{{$index}}"
                                           name="q_{{q.id}}" 
                                           ng-model="jawaban[q.id]" 
                                           ng-value="ops.skor" required ng-disabled="datas.survey.length != 0">
                                    <label class="form-check-label" for="radio_{{q.id}}_{{$index}}">
                                        {{ops.label}}
                                    </label>
                                </div>
                            </div>

                            <!-- CHECKBOX -->
                            <div ng-if="q.type == 'checkbox'" class="ps-2">
                                <div class="form-check mb-2" ng-repeat="ops in q.opsi track by $index">
                                    <input class="form-check-input" type="checkbox"
                                           id="check_{{q.id}}_{{$index}}"
                                           ng-model="jawaban[q.id][ops.label]" 
                                           ng-true-value="ops.skor" ng-false-value="0" ng-disabled="datas.survey.length != 0">
                                    <label class="form-check-label" for="check_{{q.id}}_{{$index}}">
                                        {{ops.label}}
                                    </label>
                                </div>
                            </div>

                            <!-- NUMBER -->
                            <div ng-if="q.type == 'number'">
                                <input type="text" 
                                       class="form-control form-control-lg border-primary shadow-sm rounded-2" 
                                       ng-model="jawaban[q.id]" 
                                       placeholder="Masukkan jawaban..." ng-disabled="datas.survey.length != 0" mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' '}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow rounded-pill">
                    <i class="fas fa-paper-plane me-2"></i> Verifikasi
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
