<?php
    require('fpdf186/fpdf.php');
    
    class PDF extends FPDF{
        function __construct(){
            parent::__construct('L');
        }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(20, 50, 45, 42, 30);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
            $this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);

            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

$type = $_GET['report'];

$report_header = [
    'supplier' => 'Supplier Report'
];

        //pull data from database.
        include('connection.php');

    if($type == 'supplier'){
        // Column headings
        $header = array('spid',	'screatedon', 'supplier_location', 'email',	'created_by');

        // Load supplier
        $stmt = $conn->prepare("SELECT suppliers.id as spid, suppliers.created_on as screatedon, users.first_name, users.last_name,
        suppliers.supplier_location, suppliers.email, suppliers.created_by FROM suppliers INNER JOIN users ON suppliers.created_by = users.id ORDER BY suppliers.created_on DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $suppliers = $stmt->fetchAll();


        $data = [];
        foreach($suppliers as $supplier){
            $supplier['created_by'] = $supplier['first_name'] . ' ' . $supplier['last_name'];
            unset($supplier['first_name'], $supplier['last_name']);

            

            //detect double quotes and escape any value that contains them
            array_walk($supplier, function(&$str){
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            });

            

            $data[] = [
                $supplier['spid'],
                $supplier['screatedon'],
                $supplier['supplier_location'],
                $supplier['email'],
                $supplier['created_by'],
            ];

            
    }    

    }




//Start PDF
$pdf = new PDF();
$pdf->SetFont('Arial','',20);
$pdf->AddPage();

$pdf->Cell(80);
$pdf->Cell(30,10,$report_header[$type],0,0,'C');
$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Ln();

$pdf->FancyTable($header,$data);
$pdf->Output();