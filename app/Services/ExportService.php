<?php

namespace App\Services;

use App\Models\Period;
use App\Models\Submission;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportService
{
    /**
     * Export submissions for a period as XLSX download.
     */
    public function exportSubmissions(Period $period): StreamedResponse
    {
        $submissions = Submission::with(['opd', 'answers.question', 'answers.option'])
            ->where('period_id', $period->id)
            ->orderBy('total_score', 'desc')
            ->get();

        $questions = \App\Models\Question::active()->ordered()->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rekap Submissions');

        // Header row
        $headers = ['No', 'OPD', 'Nama Responden', 'Jabatan', 'No Telpon', 'Email', 'Total Skor'];
        foreach ($questions as $q) {
            $headers[] = $q->code . ' - Jawaban';
            $headers[] = $q->code . ' - Poin';
        }

        $col = 1;
        foreach ($headers as $header) {
            $sheet->setCellValue([$col, 1], $header);
            $col++;
        }

        // Style header
        $lastCol = $col - 1;
        $headerRange = 'A1:' . $this->colLetter($lastCol) . '1';
        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4472C4']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Data rows
        $row = 2;
        $no = 1;
        foreach ($submissions as $submission) {
            $col = 1;
            $sheet->setCellValue([$col++, $row], $no++);
            $sheet->setCellValue([$col++, $row], $submission->opd->name);
            $sheet->setCellValue([$col++, $row], $submission->respondent_name);
            $sheet->setCellValue([$col++, $row], $submission->respondent_position);
            $sheet->setCellValue([$col++, $row], $submission->respondent_phone);
            $sheet->setCellValue([$col++, $row], $submission->respondent_email ?? '-');
            $sheet->setCellValue([$col++, $row], $submission->total_score);

            foreach ($questions as $q) {
                $answer = $submission->answers->firstWhere('question_id', $q->id);
                if ($answer) {
                    $sheet->setCellValue([$col++, $row], $answer->option->label . '. ' . $answer->option->option_text);
                    $sheet->setCellValue([$col++, $row], $answer->points_snapshot);
                } else {
                    $sheet->setCellValue([$col++, $row], '-');
                    $sheet->setCellValue([$col++, $row], 0);
                }
            }
            $row++;
        }

        // Auto-size columns (first 7)
        for ($i = 1; $i <= min(7, $lastCol); $i++) {
            $sheet->getColumnDimension($this->colLetter($i))->setAutoSize(true);
        }

        return $this->download($spreadsheet, "submissions_periode_{$period->year}.xlsx");
    }

    /**
     * Export ranking for a period as XLSX download.
     */
    public function exportRanking(Period $period): StreamedResponse
    {
        $submissions = Submission::with('opd')
            ->where('period_id', $period->id)
            ->orderBy('total_score', 'desc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Ranking');

        // Headers
        $sheet->setCellValue('A1', 'Ranking');
        $sheet->setCellValue('B1', 'OPD');
        $sheet->setCellValue('C1', 'Total Skor');

        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4472C4']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $row = 2;
        $rank = 1;
        foreach ($submissions as $submission) {
            $sheet->setCellValue("A{$row}", $rank++);
            $sheet->setCellValue("B{$row}", $submission->opd->name);
            $sheet->setCellValue("C{$row}", $submission->total_score);
            $row++;
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);

        return $this->download($spreadsheet, "ranking_periode_{$period->year}.xlsx");
    }

    private function download(Spreadsheet $spreadsheet, string $filename): StreamedResponse
    {
        $writer = new Xlsx($spreadsheet);

        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }

    private function colLetter(int $colNumber): string
    {
        $letter = '';
        while ($colNumber > 0) {
            $colNumber--;
            $letter = chr(65 + ($colNumber % 26)) . $letter;
            $colNumber = intdiv($colNumber, 26);
        }
        return $letter;
    }
}
