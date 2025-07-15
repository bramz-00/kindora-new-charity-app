<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GoodProposalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'good_id' => $this->good_id,
            'user_id' => $this->user_id,
            'exchange_good_id' => $this->exchange_good_id,
            'status' => $this->status,
            'reject_reason' => $this->reject_reason,
            'validated_at' => $this->validated_at,
            'req_uuid' => $this->req_uuid,
            'qr_code_svg' => $this->getQrCodeSvg(),
            'created_at' => $this->created_at,
        ];
    }

 protected function generateQrCodeSvgAsDataUri(): string
    {
        $svg = QrCode::format('svg')->size(300)->generate($this->req_uuid);
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
