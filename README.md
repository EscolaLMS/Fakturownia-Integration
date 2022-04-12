# Fakturownia-Integration

Package for generate Fakturownia Integration from order

[![swagger](https://img.shields.io/badge/documentation-swagger-green)](https://escolalms.github.io/Fakturownia-Integration/)
[![codecov](https://codecov.io/gh/EscolaLMS/Fakturownia-Integration/branch/main/graph/badge.svg?token=O91FHNKI6R)](https://codecov.io/gh/EscolaLMS/Fakturownia-Integration)
[![Tests PHPUnit in environments](https://github.com/EscolaLMS/Fakturownia-Integration/actions/workflows/test.yml/badge.svg)](https://github.com/EscolaLMS/Fakturownia-Integration/actions/workflows/test.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/60eb83351d2d550c15cb/maintainability)](https://codeclimate.com/github/EscolaLMS/Fakturownia-Integration/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/60eb83351d2d550c15cb/test_coverage)](https://codeclimate.com/github/EscolaLMS/Fakturownia-Integration/test_coverage)
[![downloads](https://img.shields.io/packagist/dt/escolalms/Fakturownia-Integration)](https://packagist.org/packages/escolalms/Fakturownia-Integration)
[![downloads](https://img.shields.io/packagist/v/escolalms/Fakturownia-Integration)](https://packagist.org/packages/escolalms/Fakturownia-Integration)
[![downloads](https://img.shields.io/packagist/l/escolalms/Fakturownia-Integration)](https://packagist.org/packages/escolalms/Fakturownia-Integration)

This package is used to add invoices to Fakturownia after dispatching event.
- `EscolaLms\Cart\Events\OrderCreated` => add invoice to Fakturownia

## Installation

Create file `.env` and set 
```
FAKTUROWNIA_HOST=
FAKTUROWNIA_TOKEN=
```
to your account in <a href="https://fakturownia.pl" target="_blank">Fakturownia</a>
