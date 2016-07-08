<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */
namespace ZfcRbacTest\Initializer;

use ZfcRbac\Initializer\AuthorizationServiceInitializer;

/**
 * @covers  \ZfcRbac\Initializer\AuthorizationServiceInitializer
 * @author  Aeneas Rekkas
 * @license MIT License
 */
class AuthorizationServiceInitializerTest extends \PHPUnit_Framework_TestCase
{
    public function testInitializer()
    {
        $authServiceClassName = 'ZfcRbac\Service\AuthorizationService';
        $initializer          = new AuthorizationServiceInitializer();
        $instance             = new AuthorizationAwareFake();
        $serviceLocator       = $this->getMock('Zend\ServiceManager\ServiceManager');
        $authorizationService = $this->getMock('ZfcRbac\Service\AuthorizationService', [], [], '', false);

        $serviceLocator->expects($this->once())
            ->method('get')
            ->with($authServiceClassName)
            ->will($this->returnValue($authorizationService));

        $initializer->initialize($instance, $serviceLocator);

        $this->assertEquals($authorizationService, $instance->getAuthorizationService());
    }
}
