<?php

declare(strict_types=1);

namespace App\Actions\StudentCard;

use App\Models\StudentCard;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GeneratePdf
{
    public function handle(StudentCard $card, string $directory): StudentCard
    {
        // Load the related user data
        $card->load('user');

        // Generate the PDF from a view with the student card data
        $pdf = Pdf::loadView((config('student-card.pdf.view')), ['card' => $card]);

        // Ensure the directory exists
        if (Storage::directoryMissing($directory)) {
            Storage::makeDirectory($directory);
        }

        // Save the generated PDF to the specified path
        $path = Storage::path($directory).DIRECTORY_SEPARATOR.$card->id.config('student-card.pdf.extension');
        $pdf->save($path);

        // Associate the saved PDF with the student card media collection
        $card->addMedia($path)
            ->toMediaCollection();

        // Refresh the student card model to reflect any recent changes
        return $card->refresh();
    }
}
