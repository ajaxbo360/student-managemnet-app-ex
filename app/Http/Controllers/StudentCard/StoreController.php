<?php

declare(strict_types=1);

namespace App\Http\Controllers\StudentCard;

use App\Actions\StudentCard\GeneratePdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCard\StoreRequest;
use App\Models\StudentCard;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): RedirectResponse
    {

        $studentCard = app(GeneratePdf::class)->handle(
            card: StudentCard::create($request->validated()),
            directory: config('student-card.pdf.directory')
        );

        return redirect()->route('dashboard');
    }
}
