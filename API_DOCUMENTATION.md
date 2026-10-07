# WEBITECHNG API Documentation

Welcome to the **WEBITECHNG** API Documentation. This document provides a detailed specification for all available backend and mobile endpoints, including the **4-Layer Payload Encryption System**.

---

## 🛡️ 4-Layer Security & Payload Encryption Engine

All mobile requests and responses passing through `/api/*` support an advanced **4-Layer Cryptographic Security Protocol** designed to defeat eavesdropping, Man-In-The-Middle (MITM) attacks, request tampering, and replay attacks.

```
 Mobile App (Client)                                    Laravel Backend (Server)
┌───────────────────────────────────────────┐           ┌───────────────────────────────────────────┐
│ Layer 1: HTTPS (TLS 1.3) + SSL Pinning    │ ────────> │ Layer 1: TLS 1.3 Termination              │
│ Layer 2: AES-256-GCM Payload Encryption   │ ────────> │ Layer 2: AES-256-GCM Decryption           │
│ Layer 3: RSA 2048 Hybrid Key Exchange     │ ────────> │ Layer 3: RSA Private Key Decryption       │
│ Layer 4: HMAC-SHA256 Signature + Nonce    │ ────────> │ Layer 4: Anti-Replay & HMAC Verification  │
└───────────────────────────────────────────┘           └───────────────────────────────────────────┘
```

### 1. The 4 Layers Explained

| Layer | Security Layer | Technical Specification & Mechanism |
| :--- | :--- | :--- |
| **Layer 1** | **Transport Security** | **HTTPS (TLS 1.3/1.2)** with **SSL Certificate Pinning** on mobile devices. Prevents network sniffing and proxy inspection tools (Charles Proxy, Fiddler, Burp Suite). |
| **Layer 2** | **Symmetric Payload Encryption** | **AES-256-GCM (Authenticated Encryption)**. Raw JSON request and response payloads are encrypted into base64 ciphertext with a 12-byte Initialization Vector (`iv`) and 16-byte Auth Tag (`tag`). |
| **Layer 3** | **Hybrid / Ephemeral Session Key** | **RSA 2048-bit Key Exchange**. The app generates a dynamic random 256-bit AES key per request/session, encrypts it using the server's **RSA Public Key** (`storage/keys/public.pem`), and sends it in the `X-Session-Key` header. |
| **Layer 4** | **Anti-Tampering & Anti-Replay** | **HMAC-SHA256 Signature** + **Unix Timestamp ($\le 300$s window)** + **Nonce Tracking**. Verifies message integrity and rejects replayed or tampered requests. |

---

### 2. Encrypted Request Protocol

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

#### Request JSON Body:
```json
{
    "payload": "Base64_Encoded_AES_256_GCM_Ciphertext",
    "iv": "Base64_Encoded_12_Byte_IV",
    "tag": "Base64_Encoded_16_Byte_Auth_Tag"
}
```

#### Encrypted Response Payload from Server:
```json
{
    "encrypted": true,
    "payload": "Base64_Encoded_Encrypted_Response",
    "iv": "Base64_Encoded_IV",
    "tag": "Base64_Encoded_Tag",
    "timestamp": 1711234568,
    "nonce": "a1b2c3d4e5f6...",
    "signature": "c5d6e7f8..."
}
```

---

### 3. Cryptographic Formulas

1. **Session Key Encryption (Layer 3)**:
   $$\text{X-Session-Key} = \text{Base64}\left(\text{RSA}_{\text{encrypt}}(\text{AES\_Key}, \text{Server\_RSA\_Public\_Key})\right)$$

2. **Payload Encryption (Layer 2)**:
   $$\text{payload}, \text{tag} = \text{AES-256-GCM}_{\text{encrypt}}(\text{Raw\_JSON}, \text{AES\_Key}, \text{IV})$$

3. **Signature Calculation (Layer 4)**:
   $$\text{X-Signature} = \text{HMAC-SHA256}\left(\text{Timestamp} + "." + \text{Nonce} + "." + \text{payload}, \text{AES\_Key}\right)$$

---

## 📌 General Information

* **Base URL**: `https://your-domain.com/api`
* **Response Content-Type**: `application/json`
* **Authentication**: Token-based authentication using **Laravel Sanctum**.
* **Header Format for Authenticated Endpoints**:
  ```http
  Authorization: Bearer {your_access_token}
  Accept: application/json
  ```

---

## 🔑 Standard Unencrypted Response Structure

Unless specified otherwise, API responses return a standardized JSON object:

```json
{
    "code": 200,
    "status": "ok",
    "message": {
        "success": [
            "Action performed successfully"
        ]
    },
    "data": { ... }
}
```

In case of validation or authorization errors:

```json
{
    "code": 401,
    "status": "error",
    "message": "Validation Error",
    "error": {
        "error": [
            "The email field is required."
        ]
    }
}
```

---

## 1. System & Merchant API Endpoints (`/api/v1`)

### 1.1 Merchant & Utility APIs

#### `POST /api/v1`
* **Description**: Main process endpoint for external API calls.
* **Authentication**: None / API Key.

#### `GET /api/v1/networks`
* **Description**: Fetch list of supported telecommunication networks.

#### `GET /api/v1/intenet/plans`
* **Description**: Fetch available data plans.

#### `POST /api/v1/intenet/buy`
* **Description**: Purchase data bundle via merchant API.
* **Body Parameters**:
  * `network`: Network ID
  * `plan`: Plan ID
  * `mobile_number`: Recipient phone number

#### `POST /api/v1/transaction/verify`
* **Description**: Verify a merchant transaction status.
* **Body Parameters**:
  * `reference`: Transaction reference string.

#### `POST /api/v1/create/customer`
* **Description**: Create a virtual customer profile.

#### `POST /api/v1/fetch/customer`
* **Description**: Retrieve customer details.

#### `POST /api/v1/identity/verify`
* **Description**: Perform identity / KYC verification.

---

## 2. User Authentication Endpoints (`/api/user`)

### 2.1 Register User
* **Endpoint**: `POST /api/user/register`
* **Auth Required**: No
* **Body Parameters**:
  * `firstname`: `string` (Required)
  * `lastname`: `string` (Required)
  * `email`: `string` (Required, unique)
  * `username`: `string` (Required, unique)
  * `mobile`: `string` (Required)
  * `password`: `string` (Required, min 6 chars, confirmed)
  * `password_confirmation`: `string` (Required)
  * `ref_by`: `string` (Optional, referral username)

### 2.2 Login User
* **Endpoint**: `POST /api/user/login`
* **Auth Required**: No
* **Body Parameters**:
  * `username`: `string` (Email or Username)
  * `password`: `string`
* **Response Payload**:
  ```json
  {
      "code": 200,
      "status": "ok",
      "data": {
          "user": { "id": 1, "username": "johndoe", "email": "john@example.com" },
          "accessToken": "1|abcdef123456789...",
          "token_type": "Bearer"
      }
  }
  ```

### 2.3 Logout
* **Endpoint**: `POST /api/user/logout`
* **Auth Required**: Yes (`auth:sanctum`)

### 2.4 Check Mail
* **Endpoint**: `POST /api/user/check-mail`
* **Body Parameters**: `email`

### 2.5 Password Reset
* `POST /api/user/password/email`: Request password reset code via email (`email`).
* `POST /api/user/password/verify-code`: Verify 6-digit reset code (`email`, `code`).
* `POST /api/user/password/reset`: Update password (`email`, `code`, `password`, `password_confirmation`).

---

## 3. Account Authorization & Verification (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 3.1 Check Verification Status
* **Endpoint**: `GET /api/user/authorization`
* **Description**: Checks email, SMS, and 2FA status and provides next required action URL.

### 3.2 Resend Verification Code
* **Endpoint**: `GET /api/user/resend-verify/{type}`
* **Path Variable**: `type` (`email` | `phone`)

### 3.3 Submit Verification Code
* `POST /api/user/verify-email`: Verify email address (`email_verified_code`).
* `POST /api/user/verify-mobile`: Verify phone number (`sms_verified_code`).
* `POST /api/user/verify-g2fa`: Verify 2-Factor Authentication (`code`).

---

## 4. Core User Dashboard & Profile (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 4.1 Dashboard Overview
* **Endpoint**: `GET /api/user/dashboard`
* **Returns**: Wallet balances (`balance`, `ref_balance`), total transactions, deposit sum, transaction history charts, latest login logs.

### 4.2 Profile Settings
* `GET /api/user/profile/profile-setting`: Get profile details.
* `POST /api/user/profile/profile-setting`: Update profile (`firstname`, `lastname`, `address`, `state`, `zip`, `city`, `image`).
* `POST /api/user/profile/change-password`: Change account password (`current_password`, `password`, `password_confirmation`).
* `POST /api/user/profile/change-trxpassword`: Set or change transaction PIN.
* `POST /api/user/profile/deactivate-account`: Request account deactivation.

### 4.3 KYC Verification
* `GET /api/user/kyc`: Fetch required KYC document fields & status.
* `POST /api/user/kyc`: Submit KYC document attachments.

### 4.4 Transactions & Receipts
* `GET /api/user/transactions`: Paginated list of user transactions.
* `GET /api/user/transaction/receipt/{id}`: Download/view transaction PDF receipt.

---

## 5. Wallet Deposits & Withdrawals (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 5.1 Deposit Methods & Payment Gateways
* `GET /api/user/deposit/methods`: Fetch active deposit payment gateways.
* `POST /api/user/deposit/insert`: Initiate deposit request (`method_code`, `amount`, `currency`).
* `POST /api/user/deposit/confirm`: Confirm automatic deposit (`transaction`).
* `GET /api/user/deposit/manual`: Fetch manual payment instructions (`transaction`).
* `POST /api/user/deposit/manual`: Submit manual deposit proof (`transaction`, custom upload fields).
* `GET /api/user/deposit/history`: Fetch deposit history.

### 5.2 Withdrawals
* `GET /api/user/withdraw/methods`: List available withdrawal channels and limits.
* `POST /api/user/withdraw`: Request a withdrawal (`method_code`, `amount`).
* `POST /api/user/withdraw/preview`: Submit final withdrawal confirmation and 2FA (`transaction`, `authenticator_code`, account details).
* `GET /api/user/withdraw/history`: Paginated list of withdrawals.

---

## 6. Financial & Payment Services (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 6.1 Bank Transfers
* `GET /api/user/bank/transfer`: Bank transfer overview.
* `GET /api/user/bank/transfer/new`: Fetch bank list.
* `POST /api/user/bank/validate/strowallet`: Validate destination account (Strowallet).
* `POST /api/user/bank/transfer/strowallet`: Perform transfer (Strowallet).
* `POST /api/user/bank/validate/monnify` & `/transfer/monnify`: Validate and transfer via Monnify.
* `POST /api/user/bank/validate/blochq` & `/transfer/blochq`: Validate and transfer via Blochq.
* `GET /api/user/bank/transfer/log`: Bank transfer history log.

### 6.2 Peer-to-Peer (P2P) Transfer
* `GET /api/user/p2p/transfer`: P2P form & limits.
* `POST /api/user/p2p/transfer`: Transfer funds directly to another user (`username`, `amount`).
* `GET /api/user/p2p/log`: P2P transaction history.

---

## 7. VTU & Bill Payment Endpoints (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 7.1 Airtime Purchase
* `GET /api/user/airtime/`: Airtime dashboard.
* `GET /api/user/airtime/airtime_operators`: Fetch operators.
* `POST /api/user/airtime/buy/airtime`: Buy airtime (`operator_id`, `amount`, `phone`).
* `GET /api/user/airtime/local` & `POST /api/user/airtime/buy/airtime/local/post`: Local airtime top-up.
* **Airtime to Cash**:
  * `GET /api/user/airtime/to_cash`: Convert airtime to cash dashboard.
  * `POST /api/user/airtime/to_cash/request`: Submit conversion request (`amount`, `network`, `phone`).
  * `GET /api/user/airtime/to_cash/history`: Airtime-to-cash log.

### 7.2 Internet Data Bundles
* `GET /api/user/internet/internet_operators`: Get data operators.
* `POST /api/user/internet/internet_operator_id`: Get plans for specific operator.
* `POST /api/user/internet/buy/internet`: Purchase internet data (`operator_id`, `plan_id`, `phone`).
* **SME Data Vendors**:
  * `POST /api/user/internet/sme/buy/internet/n3tdata`
  * `POST /api/user/internet/sme/buy/internet/gsubz`
  * `POST /api/user/internet/sme/buy/internet/gtidings`
  * `POST /api/user/internet/sme/buy/internet/natkemlinks`
  * `POST /api/user/internet/sme/buy/internet/techhub`

### 7.3 Utility & Electricity Bills
* `GET /api/user/utility/utility_operators`: List electricity providers.
* `POST /api/user/utility/utility_operator_id`: Validate meter number.
* `POST /api/user/utility/buy/utility`: Pay electricity bill (`operator_id`, `meter_number`, `amount`).

### 7.4 Cable TV Subscriptions
* `GET /api/user/cabletv/cabletv_operators`: Get TV providers (DSTV, GOTV, Startimes).
* `GET /api/user/cabletv/cabletv_verify`: Verify smartcard/IUC number.
* `POST /api/user/cabletv/buy/cabletv`: Subscribe Cable TV (`operator_id`, `iuc_number`, `plan_id`).

### 7.5 Education & Exam Pins
* `GET /api/user/education/education_operators`: List exam boards (WAEC, NECO, NABTEB).
* `POST /api/user/education/buy/education`: Purchase exam result pins.

### 7.6 Insurance
* `POST /api/user/insurance/buy/insurance/motor`: Purchase Motor Insurance.
* `POST /api/user/insurance/buy/insurance/personal`: Purchase Personal Accident Insurance.

---

## 8. Crypto Trading & Wallet (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 8.1 Buy & Sell Assets
* `POST /api/user/buy/asset/coin/details`: Fetch current buy exchange rate for selected coin.
* `POST /api/user/buy/asset/coin/buy`: Place crypto buy order.
* `POST /api/user/sell/asset/coin/details`: Fetch current sell exchange rate.
* `POST /api/user/sell/asset/coin/sell`: Place crypto sell order.

### 8.2 Crypto Wallet Management
* `GET /api/user/crypto/currencies`: List supported cryptocurrencies.
* `GET /api/user/crypto/assets/rates`: Fetch live crypto prices.
* `GET /api/user/crypto/wallet/{id}`: Wallet details and balance.
* `POST /api/user/crypto/wallet/send/{id}`: Transfer crypto to external wallet.
* `POST /api/user/crypto/wallet/swap/{id}`: Swap between crypto assets.

---

## 9. Virtual Cards & VCards (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 9.1 Virtual Card Operations
* `GET /api/user/virtualcard/request`: Fetch card creation options.
* `POST /api/user/virtualcard/request`: Issue a new USD/NGN Virtual Card.
* `GET /api/user/virtualcard/history`: List virtual cards.
* `GET /api/user/virtualcard/details/{id}`: View card numbers, CVV, expiry.
* `POST /api/user/virtualcard/fund/balance/{id}`: Fund card from account balance.
* `GET /api/user/virtualcard/status/block/{id}`: Freeze/unfreeze virtual card.

---

## 10. Giftcard Services (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 10.1 Automated Digital Giftcards
* `GET /api/user/giftcard/auto/shop`: List digital giftcard catalog.
* `POST /api/user/giftcard/auto/buy/{id}`: Purchase digital giftcard instantly.
* `GET /api/user/giftcard/auto/history`: Purchase history.

### 10.2 Manual Giftcard Trading
* `POST /api/user/giftcard/trade/sell-gift-card/{id}`: Upload and sell physical/e-code giftcard.
* `POST /api/user/giftcard/trade/buy-gift-card/{id}`: Request physical/e-code giftcard purchase.

---

## 11. Escrow & Milestones (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 11.1 Escrow Contracts
* `POST /api/user/escrow/step-one`: Initiate new escrow contract step 1.
* `POST /api/user/escrow/step-two`: Confirm escrow terms.
* `GET /api/user/escrow/details/{id}`: View contract details.
* `POST /api/user/escrow/accept/{id}`: Accept contract.
* `POST /api/user/escrow/dispatch/{id}`: Dispatch order/service.
* `POST /api/user/escrow/complete/{id}`: Mark escrow complete & release funds.
* `POST /api/user/escrow/dispute/{id}`: Open dispute.

---

## 12. Loans & Savings (`/api/user`)

* **Auth Required**: Yes (`auth:sanctum`)

### 12.1 Loans
* `GET /api/user/loan/plans`: View loan options & interest rates.
* `POST /api/user/loan/apply/{id}`: Apply for a loan.
* `GET /api/user/loan/list`: Active and previous loans.

### 12.2 Savings & Targets
* `GET /api/user/savings/`: Savings dashboard.
* `POST /api/user/savings/request/savings`: Start target savings plan.
* `POST /api/user/savings/savings/{id}`: Top-up savings plan.
* `POST /api/user/savings/close/{id}`: Early closure / break savings.

---

## 13. Merchant Webhooks

Webhooks receive incoming payloads from third-party payment gateways:

* `ANY /api/strowallet/webhook`
* `ANY /api/paylony/webhook`
* `ANY /api/monnify/webhook`
* `ANY /api/payvessel/webhook`
* `ANY /api/vpay/webhook`

---

## 📑 Summary Table of Key Routes

| Module | Route Endpoint | Method | Authentication |
| :--- | :--- | :--- | :--- |
| **Auth** | `/api/user/login` | `POST` | None |
| **Auth** | `/api/user/register` | `POST` | None |
| **User** | `/api/user/dashboard` | `GET` | Bearer Sanctum |
| **User** | `/api/user/transactions` | `GET` | Bearer Sanctum |
| **Transfer**| `/api/user/bank/transfer/strowallet` | `POST` | Bearer Sanctum |
| **VTU** | `/api/user/airtime/buy/airtime` | `POST` | Bearer Sanctum |
| **VTU** | `/api/user/internet/buy/internet` | `POST` | Bearer Sanctum |
| **Card** | `/api/user/virtualcard/request` | `POST` | Bearer Sanctum |
| **Crypto**| `/api/user/crypto/wallet/send/{id}` | `POST` | Bearer Sanctum |
