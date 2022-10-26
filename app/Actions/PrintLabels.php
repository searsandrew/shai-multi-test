<?php

namespace App\Actions;

use App\Traits\QRcode;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Routing\Router;

use App\Models\Campaign;

class PrintLabels extends FPDF
{
    use AsAction, QRcode;

    public function handle(string $campaign)
    {
        $campaign = Campaign::where('slug', $campaign)->first();
        $this->AddPage();
        $this->SetMargins(4, 13, 4);
        $this->SetLineWidth(0);

        $i = 0;
        foreach($campaign->recipients as $recipient)
        {
            $cords = $this->grid($i);
            $this->Rect($cords[0], $cords[1], 101, 51);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Arial', '', 18);
            $this->buildQR(route('recipient.qr', $recipient->uuid), 'H');
            $this->displayFPDF($this, $cords[0] + 70, $cords[1], 31, [255, 255, 255], [0, 0, 0]);
            $this->Text($cords[0] + 3, $cords[1] + 10, $recipient->name);
            $this->SetFontSize(8);
            $this->SetTextColor(33, 33, 33);
            $sorting = '';
            foreach($recipient->tags as $tag)
            {
                $sorting .= $tag['type'] . ': ' . $tag['name'] . ' | ';
            }
            $this->SetXY($cords[0] + 3, $cords[1] + 12);
            $this->MultiCell(60, 3, $sorting, 0, 'L');
            $this->Text($cords[0] + 3, $cords[1] + 47, $recipient->campaign->name);
            $this->SetTextColor(88, 88, 88);
            $this->SetXY($cords[0] + 3, $cords[1] + 21);
            $this->MultiCell(47, 3, $recipient->description, 0, 'L');

            if($i == 9)
            {
                $this->AddPage();
                $this->SetMargins(4, 13, 4);
                $this->SetLineWidth(0);

                $i = 0;
            } else {
                $i++;
            }
        }

        $this->Rect(108, 21, 101, 51);
        $this->Output();
        exit;
    }

    private function grid(int $index)
    {
        $cords = [
            0 => [2, 21],
            1 => [108, 21],
            2 => [2, 72],
            3 => [108, 72],
            4 => [2, 123],
            5 => [108, 123],
            6 => [2, 174],
            7 => [108, 174],
            8 => [2, 225],
            9 => [108, 225],
        ];

        return $cords[$index];
    }
}
