# WEBITECHNG API Testing & Swagger Documentation Guide

This guide explains how to test the **WEBITECHNG** APIs using **Swagger UI**, **Postman**, **Insomnia**, and **Laravel L5-Swagger**.

---

## 🛠️ 1. Quick Testing Tools Provided in Project

| Tool / File | File Path | Usage |
| :--- | :--- | :--- |
| **OpenAPI 3.0 Specification** | [openapi.json](file:///Users/macbook/StudioProjects/webitechng/openapi.json) | Import into **Swagger UI**, **Postman**, **Insomnia**, **Apifox**, or **Stoplight** |
| **Postman Collection (v2.1)** | [postman_collection.json](file:///Users/macbook/StudioProjects/webitechng/postman_collection.json) | Import directly into Postman for instant request testing |
| **API Documentation** | [API_DOCUMENTATION.md](file:///Users/macbook/StudioProjects/webitechng/API_DOCUMENTATION.md) | Full API specification & 4-Layer Encryption details |

---

## 🌐 2. Testing via Swagger UI Online (No Installation)

1. Open [Swagger Editor Online](https://editor.swagger.io/) or [Swagger UI Live](https://petstore.swagger.io/).
2. Click **File** $\rightarrow$ **Import File**.
3. Select the [openapi.json](file:///Users/macbook/StudioProjects/webitechng/openapi.json) file from this repository root.
4. All endpoints, parameters, request bodies, and security schemas will render interactively!

---

## 🚀 3. How to Set Up Hosted Swagger UI inside Laravel

To host an interactive Swagger UI dashboard directly at `http://127.0.0.1:8000/api/documentation` in your Laravel app:

### Step 1: Install `darkaonline/l5-swagger` Package
Run the following command in your terminal:

```bash
composer require "darkaonline/l5-swagger"
```

### Step 2: Publish L5-Swagger Configuration
```bash
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
```

### Step 3: Copy `openapi.json` to L5-Swagger Docs Folder
Copy the generated [openapi.json](file:///Users/macbook/StudioProjects/webitechng/openapi.json) to `storage/api-docs/api-docs.json`:

```bash
mkdir -p storage/api-docs
cp openapi.json storage/api-docs/api-docs.json
```

### Step 4: Access Swagger UI
Start your Laravel development server:
```bash
php artisan serve
```
Navigate to:
$$\text{\texttt{http://127.0.0.1:8000/api/documentation}}$$

---

## 🧡 4. Importing into Postman

1. Open **Postman**.
2. Click **Import** (top-left button).
3. Select [postman_collection.json](file:///Users/macbook/StudioProjects/webitechng/postman_collection.json).
4. Set the collection environment variables:
   * `base_url`: `http://127.0.0.1:8000/api`
   * `bearer_token`: `{your_sanctum_token_from_login}`
5. Execute requests directly!

---

## 🔒 5. Testing Encrypted Endpoints (4-Layer Encryption)

When testing encrypted endpoints with Postman or curl:

### Headers to Include:
```http
Content-Type: application/json
Accept: application/json
Authorization: Bearer {your_bearer_token}
X-Encrypted: true
X-Timestamp: 1711234567
X-Nonce: e9b8c7f6-1234-5678-90ab-cdef12345678
X-Signature: {HMAC_SHA256_Signature}
```

### Body Payload:
```json
{
  "payload": "Base64_Encoded_AES_256_GCM_Ciphertext",
  "iv": "Base64_Encoded_12_Byte_IV",
  "tag": "Base64_Encoded_16_Byte_Auth_Tag"
}
```
