<style>
    .head {
        font-weight: 400px;
    }

    table {
        width: 100%;
        font-size: 12px;
    }

    table tr th {
        border: 1px solid;
        padding: 5px;
        margin: 0;
        text-align: left;
    }

    table {
        border-collapse: collapse;
    }

    table td {
        border: 1px solid black;
        padding: 5px;
    }

    table tr:first-child td {
        border-top: 0;
    }

    table tr td:first-child {
        border-left: 0;
    }

    table tr:last-child td {
        border-bottom: 0;
    }

    table tr td:last-child {
        border-right: 0;
    }

    .footer table tr td {
        border: 0px solid;
        padding: 0;
        margin: 0;
    }
</style>
<div>
    <div class="head">
        <div style="width: 70%;">
            <h3>Bajaj Allianz General Insurance Company Limited</h3>
        </div>
        <div style="width: 70%;">
            <img src="https://cdn-0.motorcycle-logos.com/wp-content/uploads/2017/01/Bajaj-Logo.png" alt="" width="100%">
        </div>
    </div>
    <table>
        <tr>
            <td>Vehicle Make </td>
            <td></td>
            <td>Model</td>
            <td></td>
        </tr>
        <tr>
            <td>Registration No.</td>
            <td></td>
            <td>Passengers</td>
            <td></td>
        </tr>
        <tr>
            <td>Policy Type</td>
            <td>{{ $quotation->data->basic_details->policy_type }}</td>
            <td>Type of Vehivle</td>
            <td>{{ $quotation->data->basic_details->type_of_vehivle }}</td>
        </tr>
        <tr>
            <td>Vehicle's Cubic Capacity</td>
            <td>{{ $quotation->data->basic_details->cubic_capacity }}</td>
            <td>RTO</td>
            <td>{{ $quotation->data->basic_details->rto }}</td>
        </tr>
        <tr>
            <td>Age of Vehicle</td>
            <td>{{ $quotation->data->basic_details->age_of_vehicle }}</td>
            <td>Zone</td>
            <td>{{ $quotation->data->basic_details->zone }}</td>
        </tr>
    </table>
    <table style="margin-top: 15px;">
        <tr>
            <th colspan="4">Own Damage Premium(A)</th>
        </tr>
        <tr>
            <td>Basic for vehicle</td>
            <td>{{ $quotation->data->part_a_own_damage->vehicle_basic_rate }}</td>
            <td>Basic Own Damage</td>
            <td>{{ $quotation->data->part_a_own_damage->basic_own_damage }}</td>
        </tr>
        <tr>
            <td>Discount on OD premium</td>
            <td>{{ $quotation->data->part_a_own_damage->discount }}</td>
            <td>Loading on OD Premium</td>
            <td>{{ $quotation->data->part_a_own_damage->loading }}</td>
        </tr>
        <tr>
            <td>Basic OD after Discount/Loading</td>
            <td>{{ $quotation->data->part_a_own_damage->basic_od_after_discount }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Electrical/Electronics Accessories</td>
            <td>{{ $quotation->data->part_a_own_damage->electric_accessories_value }}</td>
            <td>Non Electrical/Electronics Accessories</td>
            <td>{{ $quotation->data->part_a_own_damage->non_electric_accessories_value }}</td>
        </tr>
        <tr>
            <td>Basic OD Before NCB</td>
            <td>{{ $quotation->data->part_a_own_damage->basic_od_before_ncb }}</td>
            <td>No Claim Bonus</td>
            <td>{{ $quotation->data->part_a_own_damage->no_claim_bonus }}</td>
        </tr>
        <tr>
            <td>Gross Own Damage</td>
            <td>{{ $quotation->data->part_a_own_damage->gross_own_damage }}</td>
            <td>Zero Dep (%)</td>
            <td>{{ $quotation->data->part_a_own_damage->zero_dep }}</td>
        </tr>
        <tr>
            <td>Other Add-On (%)</td>
            <td>{{ $quotation->data->part_a_own_damage->other_add_on_percent }}</td>
            <td>Other Add-On</td>
            <td>{{ $quotation->data->part_a_own_damage->other_add_on }}</td>
        </tr>
        <tr style="margin-top: 5px;">
            <th>Net Own Damage Premium (A) </th>
            <td>{{ $quotation->data->part_a_own_damage->final_own_damage }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <table style="margin-top: 15px;">
        <tr>
            <th colspan="4">Own Damage Premium(B)</th>
        </tr>
        <tr>
            <td>Basic TP</td>
            <td>{{ $quotation->data->part_b_liability->basic_tp }}</td>
            <td>CPA Owner Driver</td>
            <td>{{ $quotation->data->part_b_liability->cpa_owner_driver }}</td>
        </tr>
        <tr>
            <td>LL to Paid Driver</td>
            <td>{{ $quotation->data->part_b_liability->ll_to_paid_driver }}</td>
            <td>PA to Unnamed Passanger</td>
            <td>{{ $quotation->data->part_b_liability->pa_to_unnamed_passanger }}</td>
        </tr>
        <tr>
            <td>TPPD Cover</td>
            <td>{{ $quotation->data->part_b_liability->tppd_cover }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr style="margin-top: 5px;">
            <th>Final TP</th>
            <td>{{ $quotation->data->part_b_liability->final_tp }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table style="margin-top: 15px;">
        <tr></tr>
        <tr>
            <th>Premium before GST (A+B+C)</th>
            <th>{{ $quotation->data->part_c_final_premium->premium_before_taxes }}</th>
        </tr>
        <tr>
            <th>GST @18% </th>
            <th>{{ $quotation->data->part_c_final_premium->gst }}</th>
        </tr>
        <tr>
            <th>Other Cess</th>
            <th>{{ $quotation->data->part_c_final_premium->kerala_cess }}</th>
        </tr>
        <tr>
            <th>Final Premium </th>
            <th>{{ $quotation->data->part_c_final_premium->final_premium }}</th>
        </tr>
    </table>

    <div style="padding-top: 5px;">
        <div style="padding-top: 7px;">
            <p style="margin: 0px; padding: 0px; font-size: 13px;">Kindly pay cheque/DD in favor of</p>
            <h4 style="margin-top: 0;">BAJAJ ALLIANZ GENERAL INSURANCE COMPANY LIMITED</h4>
        </div>
        <div>
            <p style="margin: 0px; padding: 0px; font-size: 13px;">Documents Required:-</p>
            <table>
                <tr>
                    <td>1. Previous Policy Copy</td>
                </tr>
                <tr>
                    <td>2. RC copy</td>
                </tr>
            </table>
            <p style="font-size: 13px;">Note : In case of any claim, NCB will be revised and hence Quotation is Subject to Change.</p>
            <p style="font-size: 13px;">Quote Validity: This Quote is valid till midnight</p>
            <p style="text-align:center; font-size: 12px;">Insurance is subject matter of the solicitation.</p>
        </div>
        <div class="footer">
            <table>
                <tr>
                    <td>Adviser Name</td>
                    <td>:</td>
                    <td>{{ $user->sign->name }}</td>
                    <td>Adviser Contact</td>
                    <td>:</td>
                    <td>{{ $user->sign->mobile }}</td>
                </tr>
                <tr>
                    <td>Adviser Email</td>
                    <td>:</td>
                    <td>{{ $user->sign->email }}</td>
                    <td>Quote Date</td>
                    <td>:</td>
                    <td>{{ $quotation->date }}</td>
                </tr>
            </table>
        </div>
    </div>