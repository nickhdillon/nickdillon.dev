<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class PureFinanceService
{
	public static function getS3Path(string $file_name): string
	{
		return Storage::disk('s3')->url("pure-finance/files/{$file_name}");
	}
}
