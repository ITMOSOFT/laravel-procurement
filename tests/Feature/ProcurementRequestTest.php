<?php
namespace ITMOSOFT\Procurement\Tests\Feature;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use ITMOSOFT\Procurement\Tests\TestCase;
use ITMOSOFT\Procurement\Models\ProcurementRequest;
class ProcurementRequestTest extends TestCase
{

    public function test_request_can_be_submitted_and_approved(): void
    {
        $request = ProcurementRequest::create($this->attributes());
        $this->assertTrue($request->submit());
        $this->assertTrue($request->fresh()->approve(null, 'Within budget'));
        $this->assertSame('approved', $request->fresh()->status);
        $this->assertSame('Within budget', $request->fresh()->decision_notes);
    }

    public function test_request_can_be_rejected_and_cancelled_when_draft(): void
    {
        $request = ProcurementRequest::create($this->attributes());
        $this->assertTrue($request->cancel());
        $this->assertSame('cancelled', $request->fresh()->status);
        $other = ProcurementRequest::create($this->attributes(['reference' => (string) Str::uuid()]));
        $other->submit();
        $this->assertTrue($other->fresh()->reject(null, 'Insufficient justification'));
        $this->assertSame('rejected', $other->fresh()->status);
    }


    private function attributes(array $overrides = []): array
    {
        return array_merge(['reference' => (string) Str::uuid(), 'requester_type' => 'App\Models\User', 'requester_id' => 1, 'title' => 'Purchase laptops', 'status' => 'draft'], $overrides);
    }
}
