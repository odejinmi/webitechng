# WEBITECHNG API Documentation

Welcome to the **WEBITECHNG** API Documentation. This document provides a detailed specification for all available backend and mobile endpoints with **explicit JSON Request Payload Examples** for every POST request.

---

## 🛡️ Enforced 4-Layer Security & Payload Encryption Engine

All mobile requests and responses passing through `/api/*` **must** pass through the **4-Layer Cryptographic Security Protocol**. Plain, unencrypted JSON requests are automatically rejected with HTTP 400.

```
 Mobile App (Client)                                    Laravel Backend (Server)
┌───────────────────────────────────────────┐           ┌───────────────────────────────────────────┐
│ Layer 1: HTTPS (TLS 1.3) + SSL Pinning    │ ────────> │ Layer 1: TLS 1.3 Termination              │
│ Layer 2: AES-256-GCM Payload Encryption   │ ────────> │ Layer 2: AES-256-GCM Decryption           │
│ Layer 3: RSA 2048 Hybrid Key Exchange     │ ────────> │ Layer 3: RSA Private Key Decryption       │
│ Layer 4: HMAC-SHA256 Signature + Nonce    │ ────────> │ Layer 4: Anti-Replay & HMAC Verification  │
└───────────────────────────────────────────┘           └───────────────────────────────────────────┘
```

### 1. Encrypted Transport Wrapper (How JSON Payloads are Sent)

When sending an encrypted API request from your mobile app:

#### Required Request Headers:
```http
Content-Type: application/json
Accept: application/json
Authorization: Bearer {your_access_token}
X-Encrypted: true
X-Timestamp: 1711234567
X-Nonce: e9b8c7f6-1234-5678-90ab-cdef12345678
X-Session-Key: {RSA_Public_Key_Encrypted_AES_Key_Base64}
X-Signature: {HMAC_SHA256_Hex_Signature}
```

#### Outer Encrypted Transport JSON Body:
```json
{
    "payload": "Base64_Encoded_AES_256_GCM_Ciphertext",
    "iv": "Base64_Encoded_12_Byte_IV",
    "tag": "Base64_Encoded_16_Byte_Auth_Tag"
}
```

The JSON payloads documented below represent the **inner decrypted JSON structure** placed inside the encrypted `payload`.

---

## 📌 General Information

* **Base URL**: `https://your-domain.com/api`
* **Response Content-Type**: `application/json`
* **Authentication**: Token-based authentication using **Laravel Sanctum**.

---

## 1. System & Merchant API Endpoints (`/api/v1`)

### 1.1 Merchant & Utility APIs

#### `POST /api/v1`
* **Description**: Main process endpoint for external API calls.
* **JSON Request Payload**:
```json
{
  "api_key": "your_merchant_api_key",
  "action": "process",
  "data": {}
}
```

#### `GET /api/v1/networks`
* **Description**: Fetch list of supported telecommunication networks.

#### `GET /api/v1/intenet/plans`
* **Description**: Fetch available data plans.

#### `POST /api/v1/intenet/buy`
* **Description**: Purchase data bundle via merchant API.
* **JSON Request Payload**:
```json
{
  "network": "1",
  "plan": "500MB",
  "mobile_number": "08012345678"
}
```

#### `POST /api/v1/transaction/verify`
* **Description**: Verify a merchant transaction status.
* **JSON Request Payload**:
```json
{
  "reference": "TRX123456789"
}
```

#### `POST /api/v1/create/customer`
* **Description**: Create a virtual customer profile.
* **JSON Request Payload**:
```json
{
  "firstname": "John",
  "lastname": "Doe",
  "email": "john@example.com",
  "phone": "08012345678"
}
```

#### `POST /api/v1/fetch/customer`
* **Description**: Retrieve customer details.
* **JSON Request Payload**:
```json
{
  "customer_id": "CUST123456"
}
```

#### `POST /api/v1/identity/verify`
* **Description**: Perform identity / KYC verification.
* **JSON Request Payload**:
```json
{
  "bvn": "22123456789",
  "nin": "12345678901"
}
```

---

## 2. User Authentication Endpoints (`/api/user`)

### 2.1 Register User
* **Endpoint**: `POST /api/user/register`
* **Auth Required**: No
* **JSON Request Payload**:
```json
{
  "firstname": "John",
  "lastname": "Doe",
  "email": "john@example.com",
  "username": "johndoe",
  "mobile": "08012345678",
  "password": "Password123!",
  "password_confirmation": "Password123!",
  "ref_by": "referrer_user"
}
```

### 2.2 Login User
* **Endpoint**: `POST /api/user/login`
* **Auth Required**: No
* **JSON Request Payload**:
```json
{
  "username": "johndoe@example.com",
  "password": "Secret123!"
}
```
* **Decrypted JSON Response**:
```json
{
  "code": 200,
  "status": "ok",
  "data": {
    "user": {
      "id": 1,
      "username": "johndoe",
      "email": "john@example.com"
    },
    "accessToken": "1|abcdef123456789...",
    "token_type": "Bearer"
  }
}
```

### 2.3 Logout
* **Endpoint**: `POST /api/user/logout`
* **Auth Required**: Yes (`auth:sanctum`)
* **JSON Request Payload**:
```json
{}
```

### 2.4 Check Mail Availability
* **Endpoint**: `POST /api/user/check-mail`
* **Auth Required**: No
* **JSON Request Payload**:
```json
{
  "email": "john@example.com"
}
```

### 2.5 Password Reset
* **Request Reset Code**: `POST /api/user/password/email`
```json
{
  "email": "john@example.com"
}
```

* **Verify Code**: `POST /api/user/password/verify-code`
```json
{
  "email": "john@example.com",
  "code": "123456"
}
```

* **Update Password**: `POST /api/user/password/reset`
```json
{
  "email": "john@example.com",
  "code": "123456",
  "password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

---

## 3. Account Authorization & Verification (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 3.1 Check Verification Status
* **Endpoint**: `GET /api/user/authorization`

### 3.2 Resend Verification Code
* **Endpoint**: `GET /api/user/resend-verify/{type}` (`email` | `phone`)

### 3.3 Submit Verification Codes
* **Email Verification**: `POST /api/user/verify-email`
```json
{
  "email_verified_code": "123456"
}
```

* **SMS Verification**: `POST /api/user/verify-mobile`
```json
{
  "sms_verified_code": "123456"
}
```

* **Google 2FA Verification**: `POST /api/user/verify-g2fa`
```json
{
  "code": "123456"
}
```

---

## 4. Core User Dashboard & Profile (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 4.1 Dashboard Overview
* **Endpoint**: `GET /api/user/dashboard`

### 4.2 Submit User Profile
* **Submit Core Data**: `POST /api/user/user-data-submit`
```json
{
  "firstname": "John",
  "lastname": "Doe",
  "address": "123 Main Street",
  "state": "Lagos",
  "zip": "100001",
  "city": "Ikeja"
}
```

* **Update Profile Settings**: `POST /api/user/profile/profile-setting`
```json
{
  "firstname": "John",
  "lastname": "Doe",
  "address": "123 Main Street",
  "state": "Lagos",
  "zip": "100001",
  "city": "Ikeja",
  "gender": "male",
  "dob": "1995-05-15"
}
```

* **Change Account Password**: `POST /api/user/profile/change-password`
```json
{
  "current_password": "OldPassword123!",
  "password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

* **Change Transaction PIN**: `POST /api/user/profile/change-trxpassword`
```json
{
  "current_password": "OldPassword123!",
  "trx_password": "123456",
  "trx_password_confirmation": "123456"
}
```

* **Deactivate Account**: `POST /api/user/profile/deactivate-account`
```json
{
  "password": "Password123!",
  "reason": "Requesting account closure"
}
```

### 4.3 KYC Verification
* `GET /api/user/kyc`: Fetch required KYC document fields & status.
* `POST /api/user/kyc`: Submit KYC document details
```json
{
  "document_type": "national_id",
  "document_number": "12345678901",
  "front_image": "base64_encoded_string_or_file",
  "back_image": "base64_encoded_string_or_file"
}
```

---

## 5. Wallet Deposits & Withdrawals (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 5.1 Deposit Methods & Gateways
* `GET /api/user/deposit/methods`: Fetch active deposit payment gateways.
* `POST /api/user/deposit/insert`: Initiate deposit request
```json
{
  "amount": 5000,
  "method_code": "101",
  "currency": "NGN"
}
```

* `POST /api/user/deposit/confirm`: Confirm automatic deposit
```json
{
  "transaction": "TRX123456789"
}
```

* `POST /api/user/deposit/manual`: Submit manual deposit proof
```json
{
  "transaction": "TRX123456789",
  "payment_proof": "base64_encoded_file_string",
  "deposit_note": "Paid via mobile bank app"
}
```

* `GET /api/user/deposit/history`: Fetch deposit history.

### 5.2 Withdrawals
* `GET /api/user/withdraw/methods`: List available withdrawal channels and limits.
* `POST /api/user/withdraw`: Request a withdrawal
```json
{
  "method_code": "1",
  "amount": 10000
}
```

* `POST /api/user/withdraw/preview`: Confirm withdrawal details
```json
{
  "transaction": "TRX987654321",
  "authenticator_code": "123456",
  "account_number": "0123456789",
  "account_name": "John Doe",
  "bank_name": "GTBank"
}
```

* `GET /api/user/withdraw/history`: Paginated list of withdrawals.

---

## 6. Financial & Payment Services (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 6.1 Bank Transfers

* `GET /api/user/bank/transfer/list`: Get list of available banks
```json
{
  "code": 200,
  "status": "ok",
  "message": "Bank list retrieved successfully.",
  "data": {
    "banks": [
      {
        "bankCode": "044",
        "bankName": "Access Bank"
      }
    ]
  }
}
```

* `POST /api/user/bank/validate`: Validate bank account (Strowallet)
```json
{
  "bank_code": "011",
  "account_number": "0123456789"
}
```

* `POST /api/user/bank/transfer`: Submit bank transfer (Strowallet)
```json
{
  "bank_code": "011",
  "account_number": "0123456789",
  "amount": 5000,
  "pin": "123456",
  "narration": "Payment for services"
}
```

---

## 7. VTU & Bill Payment Endpoints (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 7.1 Airtime Purchase
* `POST /api/user/airtime/buy/airtime`: Buy Airtime
```json
{
  "operator": "123",
  "amount": 1000,
  "phone": "08012345678",
  "wallet": "main",
  "password": "123456"
}
```

* `POST /api/user/airtime/buy/airtime/local/post`: Local Airtime Purchase
```json
{
  "network": "MTN",
  "amount": 500,
  "phone": "08012345678",
  "password": "123456"
}
```

* `POST /api/user/airtime/to_cash/request`: Convert Airtime to Cash
```json
{
  "amount": 2000,
  "network": "MTN",
  "phone": "08012345678"
}
```

### 7.2 Internet Data Bundles
* `POST /api/user/internet/internet_operator_id`: Get plans for operator
```json
{
  "operator_id": "mtn"
}
```

* `POST /api/user/internet/buy/internet`: Purchase Internet Data
```json
{
  "operator": "mtn",
  "plan": "500MB",
  "phone": "08012345678",
  "wallet": "main",
  "password": "123456"
}
```

* `POST /api/user/internet/sme/buy/internet/n3tdata`: Purchase SME Data (N3TData)
```json
{
  "network": "1",
  "plan": "1001",
  "mobile_number": "08012345678",
  "port_group": "1"
}
```

### 7.3 Utility & Electricity Bills
* `POST /api/user/utility/utility_operator_id`: Validate meter number
```json
{
  "operator_id": "1",
  "meter_number": "11223344556"
}
```

* `POST /api/user/utility/buy/utility`: Pay electricity bill
```json
{
  "operator_id": "1",
  "meter_number": "11223344556",
  "amount": 3000,
  "meter_type": "prepaid",
  "password": "123456"
}
```

### 7.4 Cable TV Subscriptions
* `POST /api/user/cabletv/cabletv_operator_id`: Verify decoder smartcard number
```json
{
  "operator_id": "1",
  "iuc_number": "1234567890"
}
```

* `POST /api/user/cabletv/buy/cabletv`: Subscribe Cable TV
```json
{
  "operator_id": "1",
  "iuc_number": "1234567890",
  "plan_id": "dstv_compact",
  "password": "123456"
}
```

### 7.5 Education & Exam Pins
* `POST /api/user/education/buy/education`: Purchase exam result pins (WAEC/NECO)
```json
{
  "operator_id": "waec",
  "quantity": 1,
  "password": "123456"
}
```

### 7.6 Insurance
* `POST /api/user/insurance/buy/insurance/motor`: Purchase Motor Insurance
```json
{
  "vehicle_number": "ABC-123XY",
  "vehicle_type": "car",
  "amount": 5000,
  "password": "123456"
}
```

* `POST /api/user/insurance/buy/insurance/personal`: Purchase Personal Insurance
```json
{
  "full_name": "John Doe",
  "age": 28,
  "plan_type": "basic",
  "amount": 3000
}
```

---

## 8. Crypto Trading & Wallet (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 8.1 Buy & Sell Crypto Assets
* `POST /api/user/buy/asset/coin/details`: Fetch buy exchange rates
```json
{
  "coin_id": "BTC",
  "amount": 100
}
```

* `POST /api/user/buy/asset/coin/buy`: Place Crypto Buy Order
```json
{
  "coin_id": "BTC",
  "amount": 100,
  "wallet_address": "1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa"
}
```

* `POST /api/user/sell/asset/coin/details`: Fetch sell exchange rates
```json
{
  "coin_id": "BTC",
  "amount": 0.01
}
```

* `POST /api/user/sell/asset/coin/sell`: Place Crypto Sell Order
```json
{
  "coin_id": "BTC",
  "amount": 0.01,
  "proof_image": "base64_encoded_file_string"
}
```

### 8.2 Crypto Wallet Management
* `POST /api/user/crypto/wallet/send/{id}`: Transfer Crypto
```json
{
  "recipient_address": "0x1234567890abcdef1234567890abcdef12345678",
  "amount": 0.05,
  "pin": "123456"
}
```

* `POST /api/user/crypto/wallet/swap/{id}`: Swap Crypto
```json
{
  "target_coin": "USDT",
  "amount": 0.01
}
```

---

## 9. Virtual Cards & VCards (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 9.1 Virtual Cards
* `POST /api/user/virtualcard/request`: Request Virtual Card
```json
{
  "amount": 10,
  "card_type": "visa",
  "currency": "USD"
}
```

* `POST /api/user/virtualcard/fund/balance/{id}`: Top-Up Virtual Card
```json
{
  "amount": 25
}
```

* `POST /api/user/vcard/create/customer/add`: Create VCard Customer Profile
```json
{
  "firstname": "John",
  "lastname": "Doe",
  "email": "john@example.com",
  "phone": "08012345678",
  "dob": "1995-01-01"
}
```

---

## 10. Giftcard Services (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 10.1 Digital & Manual Giftcard Trading
* `POST /api/user/giftcard/auto/buy/{id}`: Buy Digital Giftcard
```json
{
  "amount": 50,
  "quantity": 1
}
```

* `POST /api/user/giftcard/trade/sell-gift-card/{id}`: Sell Physical/E-Code Giftcard
```json
{
  "card_value": 100,
  "image": "base64_encoded_proof",
  "comment": "Physical Amazon Giftcard $100"
}
```

---

## 11. Escrow & Milestones (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 11.1 Escrow Contracts
* `POST /api/user/escrow/step-one`: Create Escrow Contract Step 1
```json
{
  "title": "Website Development Project",
  "amount": 50000,
  "seller_email": "seller@example.com",
  "category_id": "1"
}
```

* `POST /api/user/escrow/step-two`: Confirm Escrow Terms Step 2
```json
{
  "escrow_id": "123",
  "terms": "Agreed to 14 days delivery timeline"
}
```

* `POST /api/user/escrow/milestone/{id}`: Create Escrow Milestone
```json
{
  "title": "Frontend Interface Complete",
  "amount": 20000
}
```

---

## 12. Loans & Savings (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 12.1 Loans & Target Savings
* `POST /api/user/loan/apply/{id}`: Apply for Loan
```json
{
  "amount": 20000,
  "plan_id": "1"
}
```

* `POST /api/user/savings/request/savings`: Start Target Savings
```json
{
  "title": "House Rent Savings",
  "target_amount": 500000,
  "monthly_amount": 25000
}
```

* `POST /api/user/savings/savings/{id}`: Top-Up Savings
```json
{
  "amount": 10000
}
```

---

## 13. Events & Storefronts (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 13.1 Storefront & Events
* `POST /api/user/storefront/create`: Create Storefront
```json
{
  "name": "John's Tech Store",
  "currency": "NGN"
}
```

* `POST /api/user/event/add-to-cart`: Add Event Ticket to Cart
```json
{
  "event_id": "1",
  "ticket_type_id": "2",
  "quantity": 2
}
```

* `POST /api/user/betting/fund/wallet`: Fund Betting Wallet
```json
{
  "merchant_code": "sportybet",
  "user_id": "12345678",
  "amount": 1000
}
```

* `POST /api/user/voucher/redeem`: Redeem Voucher
```json
{
  "code": "VOUCHER-12345678"
}
```

---

## 📑 Summary Table of All Key POST Requests

| Endpoint Route | Method | Required JSON Payload Keys |
| :--- | :--- | :--- |
| `/api/user/register` | `POST` | `firstname`, `lastname`, `email`, `username`, `mobile`, `password`, `password_confirmation` |
| `/api/user/login` | `POST` | `username`, `password` |
| `/api/user/verify-email` | `POST` | `email_verified_code` |
| `/api/user/verify-mobile` | `POST` | `sms_verified_code` |
| `/api/user/profile/change-password` | `POST` | `current_password`, `password`, `password_confirmation` |
| `/api/user/deposit/insert` | `POST` | `amount`, `method_code`, `currency` |
| `/api/user/withdraw` | `POST` | `method_code`, `amount` |
| `/api/user/bank/transfer/strowallet`| `POST` | `bank_code`, `account_number`, `amount`, `pin` |
| `/api/user/p2p/transfer` | `POST` | `username`, `amount`, `pin` |
| `/api/user/airtime/buy/airtime` | `POST` | `operator`, `amount`, `phone`, `password` |
| `/api/user/internet/buy/internet` | `POST` | `operator`, `plan`, `phone`, `password` |
| `/api/user/utility/buy/utility` | `POST` | `operator_id`, `meter_number`, `amount`, `meter_type`, `password` |
| `/api/user/cabletv/buy/cabletv` | `POST` | `operator_id`, `iuc_number`, `plan_id`, `password` |
| `/api/user/virtualcard/request` | `POST` | `amount`, `card_type`, `currency` |
| `/api/user/buy/asset/coin/buy` | `POST` | `coin_id`, `amount`, `wallet_address` |
