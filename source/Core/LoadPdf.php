<?php
namespace Source\Core;
use Dompdf\Dompdf;
use Source\Core\Cliente;
use Source\Models\ClienteModel;
include_once BASE_DIR."/source/autoload.php";
require_once BASE_DIR."/dompdf/src/Dompdf.php";
require_once BASE_DIR."/dompdf/src/Cellmap.php";
require_once BASE_DIR."/dompdf/src/Options.php";
require_once BASE_DIR."/dompdf/src/Canvas.php";
require_once BASE_DIR."/dompdf/lib/Cpdf.php";
require_once BASE_DIR."/dompdf/src/CanvasFactory.php";
require_once BASE_DIR."/dompdf/src/Adapter/CPDF.php";
require_once BASE_DIR."/dompdf/src/Css/Stylesheet.php";
require_once BASE_DIR."/dompdf/src/FontMetrics.php";
require_once BASE_DIR."/dompdf/src/Helpers.php";
require_once BASE_DIR."/dompdf/src/Css/Style.php";
require_once BASE_DIR."/dompdf/src/Frame.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/AbstractFrameReflower.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/Block.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/Table.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/TableRowGroup.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/TableRow.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/TableCell.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/Page.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/Image.php";
require_once BASE_DIR."/dompdf/src/FrameReflower/Text.php";

require_once BASE_DIR."/dompdf/src/FrameReflower/Inline.php";
require_once BASE_DIR."/dompdf/src/Frame/Factory.php";
require_once BASE_DIR."/dompdf/src/Frame/FrameTree.php";

require_once BASE_DIR."/dompdf/src/FrameDecorator/AbstractFrameDecorator.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/Image.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/Text.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/TableRowGroup.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/TableRow.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/TableCell.php";
require_once BASE_DIR."/dompdf/src/Image/Cache.php";
require_once BASE_DIR."/dompdf/src/Exception.php";
require_once BASE_DIR."/dompdf/src/Exception/ImageException.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/Page.php";
require_once BASE_DIR."/dompdf/src/Frame/FrameTreeList.php";
require_once BASE_DIR."/dompdf/src/Frame/FrameTreeList.php";
require_once BASE_DIR."/dompdf/src/Frame/FrameList.php";
require_once BASE_DIR."/dompdf/src/Frame/FrameListIterator.php";
require_once BASE_DIR."/dompdf/src/Frame/FrameTreeIterator.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/Block.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/Inline.php";
require_once BASE_DIR."/dompdf/src/FrameDecorator/Table.php";
require_once BASE_DIR."/dompdf/src/Css/Color.php";
require_once BASE_DIR."/dompdf/src/Css/AttributeTranslator.php";
require_once BASE_DIR."/dompdf/src/LineBox.php";
require_once BASE_DIR."/dompdf/src/Positioner/AbstractPositioner.php";
require_once BASE_DIR."/dompdf/src/Positioner/NullPositioner.php";
require_once BASE_DIR."/dompdf/src/Positioner/Block.php";
require_once BASE_DIR."/dompdf/src/Positioner/TableCell.php";

require_once BASE_DIR."/dompdf/src/Renderer/AbstractRenderer.php";
require_once BASE_DIR."/dompdf/src/Renderer/Block.php";
require_once BASE_DIR."/dompdf/src/Renderer/TableRowGroup.php";
require_once BASE_DIR."/dompdf/src/Renderer/TableCell.php";
require_once BASE_DIR."/dompdf/src/Renderer/Image.php";
require_once BASE_DIR."/dompdf/src/Renderer/Text.php";
require_once BASE_DIR."/dompdf/src/Renderer/Inline.php";
require_once BASE_DIR."/dompdf/src/Renderer.php";
require_once BASE_DIR."/dompdf/src/Positioner/Inline.php";
class LoadPdf{

    private $html;
    private $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
        $this->dompdf->setPaper("A4","portait");
        
    }
    /**
     * Carrega  o html fornecido no parametro
     * @param string o html a ser imprimido
     */
    public function load(string $html){
        $this->html = $html;
    
    }
    /**
     * Cria uma tabela com os parametros dados 
     * @param array a lista de titulos para as colunas,ou seja o cabecalho
     * @param array um array com o conteudo da tabela, cada linha da tabela é um array(ex.array associativo )
     */
    public function loadTable(string $titulo,array $head_titles, $lines)
    {
        $html = "
        <h3 style='text-align:center;color:black;font-weight:bolder;font-family: Arial, Helvetica, sans-serif;'>{$titulo}</h3>
        <table border='1' style='margin:auto;font-family: Arial, Helvetica, sans-serif;'>";
            $html .= "<thead style='background-color:black;color:white'>
            <tr>";
            foreach ($head_titles as $key => $value) 
            {
                $html .="<th style='padding:5px;'>{$value}</th>";
            }
            $html .= "</tr></thead>";
    
            
            $html .= "<tbody>";
            
            foreach ($lines as  $values) 
            {     
                $html .= "<tr>";
                foreach ($values as $keys => $value) {
                    // if($keys == "foto"){continue;}
                    $html .="<td style='padding:5px;'>{$value}</td>";
                }
                $html .= "</tr>";
            }
            $html .= "</tbody>";

        $html .="</table>";
        
        $this->html = $html;
        
    }
    public function print()
    {
        $this->dompdf->loadHtml($this->html);
        $this->dompdf->render();
        $this->dompdf->stream();

    }
}