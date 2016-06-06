<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

class HtmlToPdfHelper
{
    function opinionPaper(Array $contents, Array $lists, $certificationCompany = '佛山市口岸报关有限公司')
    {
        $essayTitle = '进出口商品预归类意见书';
// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle($essayTitle);
// set default header data
        $pdf->SetHeaderData('', '', '预归类意见书的使用说明提醒：', '进出口货物收发货人及其代理人或报关企业持预归类服务单位出具的“意见书”向海关申报时，必须在报关单备注栏目中填写“项目（S+商品项号+预归类意见书号第2-7位）”，例如：预归（S01BC00DoS02BB4567）', '', array(255, 255, 255));
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
        $pdf->SetFont('cid0cs', '', 11);
        $pdf->AddPage();
        $subtable1 = '<table><tr><td><div class="line_center">委托方联系人：' . $contents['authorizeLinkman'] . '</div></td><td><div class="line_center">联系电话：' . $contents['authorizePhone'] . '</div></td></tr></table>';
        $subtable2 = '<table><tr><td><div class="">联系电话：' . $contents['phone'] . '<br/>生成日期：' . $contents['time'] . '</div></td><td><div class="">盖章：</div></td></tr></table>';
        $pdf->SetFont('cid0cs', '', 11);
        //table列的宽度
        $widths = array('goodNum' => 70, 'chineseName' => 110, 'englishName' => 110, 'tip' => 200, 'unit' => 40, 'price' => 40, 'country' => 60);
        $htmlTr = '';
        foreach ($lists as $list) {
            $htmlTd = '';
            foreach ($list as $key => $value) {
                $htmlTd .= '<td width="' . $widths[$key] . '"><div class="tr_center">' . $value . '</div></td>';
            }
            $htmlTr .= '<tr>' . $htmlTd . '</tr>';
        }
// Set some content to print
        $html = '
                <style>
                .line_center{
                height:40px;
                line-height:30px;
                }
                .th_center{
                line-height: 40px;
                height=50px;
                text-align: center;
                }
                .tr_center{
                line-height: 20px;
                height=25px;
                text-align: center;
                }
                </style>
                <h1 style="text-align: center">' . $essayTitle . '</h1>
                <h4>预归类单位： ' . $certificationCompany . '</h4>
                <h4>预归类意见书编号： ' . $contents['certificationNum'] . '</h4>
                <table  border="1px">
                <tr style="text-align:left;"><td><div class="line_center">委托方：' . $contents['authorize'] . '</div></td></tr>
                <tr style="text-align:left;"><td><div class="line_center">委托方海关企业注册代码：' . $contents['customsNum'] . '</div></td></tr>
                <tr style="text-align:left;"><td><div class="line_center">委托方通讯地址：' . $contents['authorizeAddress'] . '</div></td></tr>
                <tr style="text-align:left;"><td>' . $subtable1 . '</td></tr>
                <tr style="text-align:left;"><td><div class="line_center">到期日期：' . $contents['expire'] . '</div></td></tr>
                <tr style="text-align:left;"><td><div class="line_center">商品中文名称：' . $contents['chineseName'] . '</div></td></tr>
                <tr style="text-align:left;"><td height="100px">规格型号：<br/>' . $contents['format'] . '</td></tr>
                <tr style="text-align:left;"><td><div class="line_center">商品英文名称：' . $contents['englishName'] . '</div></td></tr>
                <tr style="text-align:left;"><td><div class="line_center">其它名称：' . $contents['otherName'] . '</div></td></tr>
                <tr style="text-align:left;"><td><div class="line_center">委托书编码：' . $contents['authorizeNumber'] . '</div></td></tr>
                <tr style="text-align:left;"><td><div class="line_center">归类结论：' . $contents['verdict'] . '</div></td></tr>
                <tr style="text-align:left;"><td height="140px">商品描述（货物型号，规格，成分及用途）：<br/>' . $contents['goodDescription'] . '</td></tr>
                <tr style="text-align:left;"><td height="140px">依据或理由：<br/>' . $contents['rankReason'] . '</td></tr>
                <tr style="text-align:left;"><td><div class="line_center">' . $subtable2 . '</div></td></tr>
                </table>
                <h1 style="text-align: center">商品备案清单表</h1>
                <table border="1px">
                <thead><tr>
                <th bgcolor="#a9a9a9" width="70px"><div class="th_center">货号</div></th>
                <th bgcolor="#a9a9a9" width="110px"><div class="th_center">中文名称</div></th>
                <th bgcolor="#a9a9a9" width="110px"><div class="th_center">英文名称</div></th>
                <th bgcolor="#a9a9a9" width="200px"><div class="th_center">规格型号</div></th>
                <th bgcolor="#a9a9a9" width="40px"><div class="th_center">单位</div></th>
                <th bgcolor="#a9a9a9" width="40px"><div class="th_center">价格</div></th>
                <th bgcolor="#a9a9a9" width="60px"><div class="th_center">原产国</div></th>
                </tr></thead>
                <tbody>' . $htmlTr . ' </tbody></table>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
        $pdf->Output('example_001.pdf', 'I');
    }
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------
//测试数据
$contents['certificationNum'] = '_SFE00T3';
$contents['authorize'] = '佛山市南海方码照明有限公司';
$contents['customsNum'] = '9144060576734137XD';
$contents['authorizeAddress'] = '广东省佛山市南海区里水镇河村雄星上孖山工业区';
$contents['authorizeLinkman'] = '程景龙';
$contents['authorizePhone'] = '15789452650';
$contents['expire'] = '2017年05月24日';
$contents['chineseName'] = 'LED光源';
//$contents['format'] ='';
$contents['format'] = '验证输入数据也很重要，与过滤不同，验证不会从输入数据中删除信息，而只是确认用户输入是否符合预期。如果输入的是电子邮件地址，则确保用户输入的是电子邮件地址；如果需要的是电话号码，则确保用户输入的是电话号码，这就是验证要做的事儿。';
$contents['englishName'] = 'Light-Emitting Diode';
$contents['otherName'] = '';
$contents['authorizeNumber'] = 'BZMWFE201605240012';
$contents['verdict'] = '9405990000';
//$contents['goodDescription'] ='';
$contents['goodDescription'] = '验证是为了保证在应用的存储层保存符合特定格式的正确数据，如果遇到无效数据，要中止数据存储操作，并显示相应的错误信息来提醒用户输入正确的数据。验证还能避免数据库出现潜在错误，例如，如果MySQL期望使用DATETIME类型的值，而提供的却是DATE字符串，那么MySQL会报错或使用默认值，不管哪种处理方式，应用的完整性都受到无效数据的破坏。';
//$contents['rankReason'] ='';
$contents['rankReason'] = '委托是对一个类的功能进行扩展和复用的方法。它的做法是：写一个附加的类提供附加的功能，并使用原来的类的实例提供原有的功能。假设我们有一个 TeamLead 类，将其既定任务委托给一个关联辅助对象 JuniorDeveloper 来完成：本来 TeamLead 处理 writeCode 方法，Usage 调用 TeamLead 的该方法，但现在 TeamLead 将 writeCode 的实现委托给 JuniorDeveloper 的 writeBadCode 来实现，但 Usage 并没有感知在执行 writeBadCode 方法。';
$contents['phone'] = '15628562025';
$contents['time'] = '2016年05月24日';

$lists = array(
    array('goodNum' => 'FM052401', 'chineseName' => 'LED光源', 'englishName' => 'Light-Emitting Diode', 'tip' => '12V/18.5W/4000K SR111-18-16D-940-03-S3', 'unit' => '', 'price' => '', 'country' => '澳洲'),
    array('goodNum' => 'F052401', 'chineseName' => 'LED', 'englishName' => 'Light-Emitting Diode', 'tip' => '12V/18.5W/4000K SR111-18-16D-940-03-S3', 'unit' => '个', 'price' => '', 'country' => ''),
    array('goodNum' => 'M052401', 'chineseName' => 'LED光源', 'englishName' => 'Light-Emitting Diode', 'tip' => '12V/18.5W/4000K SR111-18-16D-940-03-S3', 'unit' => '', 'price' => '100', 'country' => ''));
$test = new HtmlToPdfHelper();
$test->opinionPaper($contents, $lists);

