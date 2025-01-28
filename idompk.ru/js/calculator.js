$(document).ready(function() {
    $('.calcSelectFree, .calcSelectDoc, .calcSelectNetworks').click(function () {
        doCalcWidget();
    });
    $('.commonSq, .terraceSq').keyup(function () {
        doCalcWidget();
    });

    doCalcWidget();
});

function doCalcWidget()
{
    let is_esciz = $('.docEsciz.is-active').length;
    let is_arch = $('.docArch.is-active').length;
    let is_const = $('.docConst.is-active').length;

    let is_water = $('.nwWater.is-active').length;
    let is_heating = $('.nwHeating.is-active').length;
    let is_electro = $('.nwElectro.is-active').length;

    let is_3d_vision = $('.fr3dVision.is-active').length;
    let is_interactive_3d = $('.frInteractive3d.is-active').length;
    let is_calc_matireal = $('.frCalcMatireal.is-active').length;

    let sh = Number($('.commonSq').val());
    let sp = Number($('.terraceSq').val());
    let ss = sh + (sp*0.5);
    $('.calcMnozh').html(sp*0.5);


    let result_1 = 0;
    let result_2 = 0;

    if(is_esciz)
        result_1 += calc_prices['esciz']*ss;

    if(is_arch)
        result_1 += calc_prices['arch_project']*ss;

    if(is_const)
        result_1 += calc_prices['construct_project']*ss;

    if(is_water)
        result_1 += calc_prices['water']*ss;

    if(is_heating)
        result_1 += calc_prices['heating']*ss;

    if(is_electro)
        result_1 += calc_prices['electro']*ss;

    if(is_3d_vision)
        result_2 += calc_prices['3d_vision'];

    if(is_interactive_3d)
        result_2 += calc_prices['interactive_3d'];

    if(is_calc_matireal)
        result_2 += calc_prices['calc_matireal'];

    let sum = result_1 + result_2;
    sum = new Intl.NumberFormat('de-DE').format(sum);

    $('.clacItog').html(sum);
}