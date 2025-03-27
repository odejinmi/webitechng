<?php

namespace App\Constants;

class Status
{

	const ENABLE  = 1;
	const DISABLE = 0;

	const YES = 1;
	const NO  = 0;

	const VERIFIED   = 1;
	const UNVERIFIED = 0;

    const FDR_RUNNING = 1;
    const FDR_CLOSED = 2;

	const PAYMENT_INITIATE = 0;
	const PAYMENT_SUCCESS  = 1;
	const PAYMENT_PENDING  = 2;
	const PAYMENT_REJECT   = 3;

	const TICKET_OPEN   = 0;
	const TICKET_ANSWER = 1;
	const TICKET_REPLY  = 2;
	const TICKET_CLOSE  = 3;

	const PRIORITY_LOW    = 1;
	const PRIORITY_MEDIUM = 2;
	const PRIORITY_HIGH   = 3;

	const USER_ACTIVE = 1;
	const USER_BAN    = 0;

	const ORDER_PENDING    = 0;
	const ORDER_PROCESSING = 4;
	const ORDER_COMPLETED  = 1;
	const ORDER_CANCELLED  = 2;
	const ORDER_REFUNDED   = 3;

	const API_ORDER_PLACE = 1;
	const API_ORDER_NOT_PLACE = 0;


    const CHARGE_PAYER_SELLER = 1;
    const CHARGE_PAYER_BUYER  = 2;

    const ESCROW_NOT_ACCEPTED = 0;
    const ESCROW_COMPLETED    = 1;
    const ESCROW_ACCEPTED     = 2;
    const ESCROW_DISPUTED     = 8;
    const ESCROW_CANCELLED    = 9;

    const MILESTONE_FUNDED   = 1;
    const MILESTONE_UNFUNDED = 0;

    const CONVERSION_RUNNING = 1;
    const CONVERSION_CLOSE   = 0;

    const LOAN_PENDING = 0;
    const LOAN_RUNNING = 1;
    const LOAN_PAID = 2;
    const LOAN_REJECTED = 3;
	
}
