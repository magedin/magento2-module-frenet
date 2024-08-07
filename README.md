# Frenet Gateway de Fretes para Magento 2
Integre seu Magento 2 aos serviços da Frenet de forma rápida e fácil.

[![Magento 2 Coding Standard](https://github.com/magedin/magento2-module-frenet/actions/workflows/coding-standard.yml/badge.svg?branch=master)](https://github.com/magedin/magento2-module-frenet/actions/workflows/coding-standard.yml)
[![Magento 2 PHP Unit Tests](https://github.com/magedin/magento2-module-frenet/actions/workflows/php-unit.yml/badge.svg)](https://github.com/magedin/magento2-module-frenet/actions/workflows/php-unit.yml)

![Packagist](https://img.shields.io/packagist/dt/frenet/frenet-magento2)
[![PHP v7.3 and above](https://img.shields.io/badge/php-v7.3%20and%20above-blue.svg)](http://www.php.net)
[![PHP v8.0 and above](https://img.shields.io/badge/php-v8.0%20and%20above-blue.svg)](http://www.php.net)
[![Magento v2.3](https://img.shields.io/badge/magento-v2.3-green.svg)](https://magento.com/)
[![Magento v2.4](https://img.shields.io/badge/magento-v2.4-green.svg)](https://magento.com/)

## Compatibilidade

Esta versão do módulo é compatível com as seguintes versões do Magento 2:

- Magento 2.3
- Magento 2.4

## Instalação
> É recomendado que você tenha um ambiente de testes para validar alterações e atualizações antes de atualizar sua loja em produção.

> A instalação do módulo é feita utilizando o Composer. Para baixar e instalar o Composer no seu ambiente acesse https://getcomposer.org/download/ e caso tenha dúvidas de como utilizá-lo consulte a [documentação oficial do Composer](https://getcomposer.org/doc/).

Abra o terminal e navegue até o diretório raíz da sua instalação do Magento 2 e execute os seguintes comandos:

```
> composer require magedin/module-frenet         // Faz a requisição do módulo da Frenet
> php bin/magento module:enable MagedIn_Frenet   // Ativa o módulo no Magento
> php bin/magento setup:upgrade                  // Registra a extensão
> php bin/magento setup:di:compile               // Recompila o projeto Magento
```

<div style="text-align: center;">
    <a href="https://github.com/magedin/magento2-module-frenet/">
        <img src="https://raw.githubusercontent.com/magedin/assets/c0cd4f15cee6580c6c96848400cf089e91417529/images/logo/magedin_horizontal.svg?raw=true" width="200" alt="MagedIn Technology" title="MagedIn Technology"/>
    </a>
</div>
