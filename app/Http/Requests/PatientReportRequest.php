<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Hematology fields
            'hematology.*.cbc_esr.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.cbc_esr.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.tc_dc_hb_esr.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.tc_dc_hb_esr.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.blood_film.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.blood_film.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.platelet_count.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.platelet_count.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.tce.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.tce.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.mp.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.mp.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.htc_mcv_mcc_mch.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.htc_mcv_mcc_mch.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.reticulocyte_count.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.reticulocyte_count.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.bt_ct.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.bt_ct.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.prothrombine_time.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.prothrombine_time.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.aptt.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.aptt.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.fibrinogen.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.fibrinogen.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.fdp.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.fdp.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.dimer.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'hematology.*.dimer.*.condition' => 'nullable|string|regex:/^[\pL\s]+$/u',

            // Biochemistry fields
            'biochemistry.*.glucose.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.lipid_profile.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.urea_bun.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.creatine.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.creatine_clearance_rate.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.bilirubin.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.ast.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.alt.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.alkaline_phosphates.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.ck.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.ck_mb.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.ldh.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.amylase.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.pro_bnp.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.pancreatic_amylase.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.lipage.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.acid_phosphates.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.s_total_protine.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.s_albumin.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.a_g_ration.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.uric_acid.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.arterial_blood_gas.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.s_electrolytes.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.s_calcium.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.y_gt.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.ammonia.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.s_iron.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.tibc.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.s_ferritin.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.magnisium.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'biochemistry.*.inorganic_phosphate.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',

            // Stool fields
            'stool.*.r_e.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'stool.*.reduction_substance.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',
            'stool.*.occult_blood_test.*.rate' => 'nullable|string|regex:/^[\pL\s]+$/u',

            // Urine fields
        ];
    }
}
