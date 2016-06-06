<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

class HtmlToPdfHelper
{
    function opinionPaper(Array $contents)
    {
        $essayTitle = '商品预归类申请表';
// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle($essayTitle);
// set default header data
        $pdf->SetHeaderData('', '', '', '', '', array(255, 255, 255));
        $pdf->setFooterData(array(0, 0, 0), array(255, 255, 255));
// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Set font
        $pdf->SetFont('simfang', '', 9);
        $pdf->AddPage();
// Set some content to print
        $html = '
                <style>
                .line_center{
                height:35px;
                line-height:25px;
                }
                .th_center{
                line-height: 40px;
                height=50px;
                text-align: center;
                }
                .tr_center{
                line-height: 16px;
                }
                </style>
				<h2 style="text-align: center">' . $essayTitle . '</h2>
				<table border="1px">
				<tbody>
				<tr><td width="110px"><div class="line_center">*企业名称</div></td><td width="250px"><div class="line_center">佛山市荣高智能科技有限公司</div></td><td width="90px"><div class="line_center">*进出口类别</div></td><td width="180px"><div class="line_center">出口</div></td></tr>
				<tr><td><div class="line_center">*通讯地址</div></td><td colspan="3"><div class="line_center">广东省佛山市南海区里水镇河村雄星上孖山工业区</div></td></tr>
				<tr><td><div class="line_center">*企业编码</div></td><td><div class="line_center">44006967416</div></td><td><div class="line_center">传真电话</div></td><td><div class="line_center"></div></td></tr>
				<tr><td><div class="line_center">*企业类别</div></td><td><div class="line_center">B</div></td><td><div class="line_center">*是否加急</div></td><td><div class="line_center">否</div></td></tr>
				<tr><td><div class="line_center">*联系人</div></td><td><div class="line_center">赖国华</div></td><td><div class="line_center">*联系手机</div></td><td><div class="line_center">18520224123</div></td></tr>
				<tr><td><div class="line_center">*电子邮件</div></td><td><div class="line_center">anson@ronggaodoor.com</div></td><td><div class="line_center">*固定电话</div></td><td><div class="line_center">0757-88307970</div></td></tr>
				<tr><td><div class="line_center">*商品名称</div></td><td><div class="line_center">铝合金电动伸缩门</div></td><td><div class="line_center">*填报日期</div></td><td><div class="line_center">2016年5月24日</div></td></tr>
				<tr><td><div class="line_center">英文名称</div></td><td><div class="line_center">Aluminum electric retractable gate</div></td><td><div class="line_center">其它名称</div></td><td><div class="line_center">无</div></td></tr>
				<tr><td height="40px"><div class="line_center">*商品规格型号品牌</div></td><td><div class="tr_center">品牌：荣高，型号：无 规格：长10×宽0.63×高1.6(m)</div></td><td><div class="line_center">*计量单位</div></td><td><div class="line_center">套</div></td></tr>
				<tr><td><div class="line_center">*企业原商品编码</div></td><td><div class="line_center">8543709990</div></td><td><div class="line_center">*贸易方式</div></td><td><div class="line_center">一般交易</div></td></tr>
				<tr><td><div class="line_center">成品或料件</div></td><td><div class="line_center">成品</div></td><td><div class="line_center">备注</div></td><td><div class="line_center">出口</div></td></tr>
				<tr><td height="160px"><div class="line_center">*商品描述</div></td><td colspan="3"><div class="tr_center">佛山市荣高智能科技有限公司</div></td></tr>
				<tr><td height="110px"><div class="line_center">*商品图片</div></td><td colspan="3"><div></div><img height="110px" width="120px" src="test1.jpg"/>&nbsp;<img height="110px" width="120px" src="test3.png"/>&nbsp;<img height="110px" width="120px" src="test3.png"/>&nbsp;<img height="110px" width="120px" src="test2.png"/><div></div></td></tr>
				<tr><td height="100px"><div class="line_center">*其它资料</div></td><td colspan="3"><div class="tr_center">佛山市荣高智能科技有限公司</div></td></tr>
				<tr style="text-align: left;"><td colspan="4"><div class="tr_center">注：1、带‘*’为必填项。<br/>&nbsp;&nbsp;&nbsp;&nbsp;2、本申请表及随附资料经申请企业盖章（骑缝章）确认上述申报内容真实无误方有效。<br/>&nbsp;&nbsp;&nbsp;&nbsp;3、企业对实际进出口商品状态和本申报表所述商品的一致性和真实性承担相应法律责任。</div></td></tr>
				</tbody>
				</table>
				<span style="text-align:left;">责任保证书：<br/>
				一、我单位现委托贵司代为进行商品预归类，并出具《预归类建议书》。<br/>
				二、我单位保证遵守《海关法》和国家有关法律法规，保证所提供的资料和信息真实、准确、完整、单货相符。否则，愿承担相关法律责任和由此导致的一切后果。</span>
				<h4>申请企业（盖章）：</h4>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, 'C', true);
        $pdf->Output('example_001.pdf', 'I');
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------
//测试数据
$contents = array();
$test = new HtmlToPdfHelper();
$test->opinionPaper($contents);

