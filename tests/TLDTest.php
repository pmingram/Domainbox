<?php

use MadeITBelgium\Domainbox\TLDs\TLD;

class TLDTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testObjects()
    {
        $this->assertEquals([
            '.ac.nz'            => new MadeITBelgium\Domainbox\TLDs\Acnz(),
            '.ac'               => new MadeITBelgium\Domainbox\TLDs\Ac(),
            '.academy'          => new MadeITBelgium\Domainbox\TLDs\Academy(),
            '.accountant'       => new MadeITBelgium\Domainbox\TLDs\Accountant(),
            '.accountants'      => new MadeITBelgium\Domainbox\TLDs\Accountants(),
            '.actor'            => new MadeITBelgium\Domainbox\TLDs\Actor(),
            '.adult'            => new MadeITBelgium\Domainbox\TLDs\Adult(),
            '.ae.org'           => new MadeITBelgium\Domainbox\TLDs\Aeorg(),
            '.ag'               => new MadeITBelgium\Domainbox\TLDs\Ag(),
            '.agency'           => new MadeITBelgium\Domainbox\TLDs\Agency(),
            '.airforce'         => new MadeITBelgium\Domainbox\TLDs\Airforce(),
            '.apartments'       => new MadeITBelgium\Domainbox\TLDs\Apartments(),
            '.ar.com'           => new MadeITBelgium\Domainbox\TLDs\Arcom(),
            '.archi'            => new MadeITBelgium\Domainbox\TLDs\Archi(),
            '.army'             => new MadeITBelgium\Domainbox\TLDs\Army(),
            '.art'              => new MadeITBelgium\Domainbox\TLDs\Art(),
            '.asia'             => new MadeITBelgium\Domainbox\TLDs\Asia(),
            '.associates'       => new MadeITBelgium\Domainbox\TLDs\Associates(),
            '.at'               => new MadeITBelgium\Domainbox\TLDs\At(),
            '.attorney'         => new MadeITBelgium\Domainbox\TLDs\Attorney(),
            '.auction'          => new MadeITBelgium\Domainbox\TLDs\Auction(),
            '.audio'            => new MadeITBelgium\Domainbox\TLDs\Audio(),
            '.auto'             => new MadeITBelgium\Domainbox\TLDs\Auto(),
            '.band'             => new MadeITBelgium\Domainbox\TLDs\Band(),
            '.bar'              => new MadeITBelgium\Domainbox\TLDs\Bar(),
            '.barcelona'        => new MadeITBelgium\Domainbox\TLDs\Barcelona(),
            '.bargains'         => new MadeITBelgium\Domainbox\TLDs\Bargains(),
            '.bayern'           => new MadeITBelgium\Domainbox\TLDs\Bayern(),
            '.be'               => new MadeITBelgium\Domainbox\TLDs\Be(),
            '.beer'             => new MadeITBelgium\Domainbox\TLDs\Beer(),
            '.berlin'           => new MadeITBelgium\Domainbox\TLDs\Berlin(),
            '.best'             => new MadeITBelgium\Domainbox\TLDs\Best(),
            '.bid'              => new MadeITBelgium\Domainbox\TLDs\Bid(),
            '.bike'             => new MadeITBelgium\Domainbox\TLDs\Bike(),
            '.bingo'            => new MadeITBelgium\Domainbox\TLDs\Bingo(),
            '.bio'              => new MadeITBelgium\Domainbox\TLDs\Bio(),
            '.biz'              => new MadeITBelgium\Domainbox\TLDs\Biz(),
            '.black'            => new MadeITBelgium\Domainbox\TLDs\Black(),
            '.blackfriday'      => new MadeITBelgium\Domainbox\TLDs\Blackfriday(),
            '.blog'             => new MadeITBelgium\Domainbox\TLDs\Blog(),
            '.blue'             => new MadeITBelgium\Domainbox\TLDs\Blue(),
            '.boutique'         => new MadeITBelgium\Domainbox\TLDs\Boutique(),
            '.br.com'           => new MadeITBelgium\Domainbox\TLDs\Brcom(),
            '.build'            => new MadeITBelgium\Domainbox\TLDs\Build(),
            '.builders'         => new MadeITBelgium\Domainbox\TLDs\Builders(),
            '.business'         => new MadeITBelgium\Domainbox\TLDs\Business(),
            '.buzz'             => new MadeITBelgium\Domainbox\TLDs\Buzz(),
            '.bz'               => new MadeITBelgium\Domainbox\TLDs\Bz(),
            '.cab'              => new MadeITBelgium\Domainbox\TLDs\Cab(),
            '.cafe'             => new MadeITBelgium\Domainbox\TLDs\Cafe(),
            '.camera'           => new MadeITBelgium\Domainbox\TLDs\Camera(),
            '.camp'             => new MadeITBelgium\Domainbox\TLDs\Camp(),
            '.capetown'         => new MadeITBelgium\Domainbox\TLDs\Capetown(),
            '.capital'          => new MadeITBelgium\Domainbox\TLDs\Capital(),
            '.car'              => new MadeITBelgium\Domainbox\TLDs\Car(),
            '.cards'            => new MadeITBelgium\Domainbox\TLDs\Cards(),
            '.care'             => new MadeITBelgium\Domainbox\TLDs\Care(),
            '.careers'          => new MadeITBelgium\Domainbox\TLDs\Careers(),
            '.cars'             => new MadeITBelgium\Domainbox\TLDs\Cars(),
            '.casa'             => new MadeITBelgium\Domainbox\TLDs\Casa(),
            '.cash'             => new MadeITBelgium\Domainbox\TLDs\Cash(),
            '.casino'           => new MadeITBelgium\Domainbox\TLDs\Casino(),
            '.cat'              => new MadeITBelgium\Domainbox\TLDs\Cat(),
            '.catering'         => new MadeITBelgium\Domainbox\TLDs\Catering(),
            '.cc'               => new MadeITBelgium\Domainbox\TLDs\Cc(),
            '.center'           => new MadeITBelgium\Domainbox\TLDs\Center(),
            '.ceo'              => new MadeITBelgium\Domainbox\TLDs\Ceo(),
            '.ch'               => new MadeITBelgium\Domainbox\TLDs\Ch(),
            '.chat'             => new MadeITBelgium\Domainbox\TLDs\Chat(),
            '.cheap'            => new MadeITBelgium\Domainbox\TLDs\Cheap(),
            '.christmas'        => new MadeITBelgium\Domainbox\TLDs\Christmas(),
            '.church'           => new MadeITBelgium\Domainbox\TLDs\Church(),
            '.city'             => new MadeITBelgium\Domainbox\TLDs\City(),
            '.claims'           => new MadeITBelgium\Domainbox\TLDs\Claims(),
            '.cleaning'         => new MadeITBelgium\Domainbox\TLDs\Cleaning(),
            '.click'            => new MadeITBelgium\Domainbox\TLDs\Click(),
            '.clinic'           => new MadeITBelgium\Domainbox\TLDs\Clinic(),
            '.clothing'         => new MadeITBelgium\Domainbox\TLDs\Clothing(),
            '.cloud'            => new MadeITBelgium\Domainbox\TLDs\Cloud(),
            '.club'             => new MadeITBelgium\Domainbox\TLDs\Club(),
            '.cn.com'           => new MadeITBelgium\Domainbox\TLDs\Cncom(),
            '.co.ag'            => new MadeITBelgium\Domainbox\TLDs\Coag(),
            '.co.at'            => new MadeITBelgium\Domainbox\TLDs\Coat(),
            '.co.bz'            => new MadeITBelgium\Domainbox\TLDs\Cobz(),
            '.co.com'           => new MadeITBelgium\Domainbox\TLDs\Cocom(),
            '.co.dm'            => new MadeITBelgium\Domainbox\TLDs\Codm(),
            '.co.gg'            => new MadeITBelgium\Domainbox\TLDs\Cogg(),
            '.co.im'            => new MadeITBelgium\Domainbox\TLDs\Coim(),
            '.co.je'            => new MadeITBelgium\Domainbox\TLDs\Coje(),
            '.co.lc'            => new MadeITBelgium\Domainbox\TLDs\Colc(),
            '.co.nz'            => new MadeITBelgium\Domainbox\TLDs\Conz(),
            '.co'               => new MadeITBelgium\Domainbox\TLDs\Co(),
            '.co.uk'            => new MadeITBelgium\Domainbox\TLDs\Couk(),
            '.co.za'            => new MadeITBelgium\Domainbox\TLDs\Coza(),
            '.coach'            => new MadeITBelgium\Domainbox\TLDs\Coach(),
            '.codes'            => new MadeITBelgium\Domainbox\TLDs\Codes(),
            '.coffee'           => new MadeITBelgium\Domainbox\TLDs\Coffee(),
            '.college'          => new MadeITBelgium\Domainbox\TLDs\College(),
            '.cologne'          => new MadeITBelgium\Domainbox\TLDs\Cologne(),
            '.com.ag'           => new MadeITBelgium\Domainbox\TLDs\Comag(),
            '.com.bz'           => new MadeITBelgium\Domainbox\TLDs\Combz(),
            '.com.co'           => new MadeITBelgium\Domainbox\TLDs\Comco(),
            '.com.de'           => new MadeITBelgium\Domainbox\TLDs\Comde(),
            '.com.es'           => new MadeITBelgium\Domainbox\TLDs\Comes(),
            '.com.hn'           => new MadeITBelgium\Domainbox\TLDs\Comhn(),
            '.com.im'           => new MadeITBelgium\Domainbox\TLDs\Comim(),
            '.com.lc'           => new MadeITBelgium\Domainbox\TLDs\Comlc(),
            '.com.mx'           => new MadeITBelgium\Domainbox\TLDs\Commx(),
            '.com'              => new MadeITBelgium\Domainbox\TLDs\Com(),
            '.com.pl'           => new MadeITBelgium\Domainbox\TLDs\Compl(),
            '.com.sc'           => new MadeITBelgium\Domainbox\TLDs\Comsc(),
            '.com.se'           => new MadeITBelgium\Domainbox\TLDs\Comse(),
            '.com.vc'           => new MadeITBelgium\Domainbox\TLDs\Comvc(),
            '.community'        => new MadeITBelgium\Domainbox\TLDs\Community(),
            '.company'          => new MadeITBelgium\Domainbox\TLDs\Company(),
            '.computer'         => new MadeITBelgium\Domainbox\TLDs\Computer(),
            '.condos'           => new MadeITBelgium\Domainbox\TLDs\Condos(),
            '.construction'     => new MadeITBelgium\Domainbox\TLDs\Construction(),
            '.consulting'       => new MadeITBelgium\Domainbox\TLDs\Consulting(),
            '.contractors'      => new MadeITBelgium\Domainbox\TLDs\Contractors(),
            '.cooking'          => new MadeITBelgium\Domainbox\TLDs\Cooking(),
            '.cool'             => new MadeITBelgium\Domainbox\TLDs\Cool(),
            '.country'          => new MadeITBelgium\Domainbox\TLDs\Country(),
            '.coupons'          => new MadeITBelgium\Domainbox\TLDs\Coupons(),
            '.courses'          => new MadeITBelgium\Domainbox\TLDs\Courses(),
            '.credit'           => new MadeITBelgium\Domainbox\TLDs\Credit(),
            '.creditcard'       => new MadeITBelgium\Domainbox\TLDs\Creditcard(),
            '.cricket'          => new MadeITBelgium\Domainbox\TLDs\Cricket(),
            '.cruises'          => new MadeITBelgium\Domainbox\TLDs\Cruises(),
            '.cx'               => new MadeITBelgium\Domainbox\TLDs\Cx(),
            '.cymru'            => new MadeITBelgium\Domainbox\TLDs\Cymru(),
            '.dance'            => new MadeITBelgium\Domainbox\TLDs\Dance(),
            '.date'             => new MadeITBelgium\Domainbox\TLDs\Date(),
            '.dating'           => new MadeITBelgium\Domainbox\TLDs\Dating(),
            '.de.com'           => new MadeITBelgium\Domainbox\TLDs\Decom(),
            '.de'               => new MadeITBelgium\Domainbox\TLDs\De(),
            '.deals'            => new MadeITBelgium\Domainbox\TLDs\Deals(),
            '.degree'           => new MadeITBelgium\Domainbox\TLDs\Degree(),
            '.delivery'         => new MadeITBelgium\Domainbox\TLDs\Delivery(),
            '.democrat'         => new MadeITBelgium\Domainbox\TLDs\Democrat(),
            '.dental'           => new MadeITBelgium\Domainbox\TLDs\Dental(),
            '.dentist'          => new MadeITBelgium\Domainbox\TLDs\Dentist(),
            '.desi'             => new MadeITBelgium\Domainbox\TLDs\Desi(),
            '.design'           => new MadeITBelgium\Domainbox\TLDs\Design(),
            '.diamonds'         => new MadeITBelgium\Domainbox\TLDs\Diamonds(),
            '.diet'             => new MadeITBelgium\Domainbox\TLDs\Diet(),
            '.digital'          => new MadeITBelgium\Domainbox\TLDs\Digital(),
            '.direct'           => new MadeITBelgium\Domainbox\TLDs\Direct(),
            '.directory'        => new MadeITBelgium\Domainbox\TLDs\Directory(),
            '.discount'         => new MadeITBelgium\Domainbox\TLDs\Discount(),
            '.dm'               => new MadeITBelgium\Domainbox\TLDs\Dm(),
            '.doctor'           => new MadeITBelgium\Domainbox\TLDs\Doctor(),
            '.dog'              => new MadeITBelgium\Domainbox\TLDs\Dog(),
            '.domains'          => new MadeITBelgium\Domainbox\TLDs\Domains(),
            '.download'         => new MadeITBelgium\Domainbox\TLDs\Download(),
            '.durban'           => new MadeITBelgium\Domainbox\TLDs\Durban(),
            '.education'        => new MadeITBelgium\Domainbox\TLDs\Education(),
            '.email'            => new MadeITBelgium\Domainbox\TLDs\Email(),
            '.energy'           => new MadeITBelgium\Domainbox\TLDs\Energy(),
            '.engineer'         => new MadeITBelgium\Domainbox\TLDs\Engineer(),
            '.engineering'      => new MadeITBelgium\Domainbox\TLDs\Engineering(),
            '.enterprises'      => new MadeITBelgium\Domainbox\TLDs\Enterprises(),
            '.equipment'        => new MadeITBelgium\Domainbox\TLDs\Equipment(),
            '.es'               => new MadeITBelgium\Domainbox\TLDs\Es(),
            '.estate'           => new MadeITBelgium\Domainbox\TLDs\Estate(),
            '.eu.com'           => new MadeITBelgium\Domainbox\TLDs\Eucom(),
            '.eu'               => new MadeITBelgium\Domainbox\TLDs\Eu(),
            '.eus'              => new MadeITBelgium\Domainbox\TLDs\Eus(),
            '.events'           => new MadeITBelgium\Domainbox\TLDs\Events(),
            '.exchange'         => new MadeITBelgium\Domainbox\TLDs\Exchange(),
            '.expert'           => new MadeITBelgium\Domainbox\TLDs\Expert(),
            '.exposed'          => new MadeITBelgium\Domainbox\TLDs\Exposed(),
            '.express'          => new MadeITBelgium\Domainbox\TLDs\Express(),
            '.fail'             => new MadeITBelgium\Domainbox\TLDs\Fail(),
            '.faith'            => new MadeITBelgium\Domainbox\TLDs\Faith(),
            '.family'           => new MadeITBelgium\Domainbox\TLDs\Family(),
            '.fans'             => new MadeITBelgium\Domainbox\TLDs\Fans(),
            '.farm'             => new MadeITBelgium\Domainbox\TLDs\Farm(),
            '.fashion'          => new MadeITBelgium\Domainbox\TLDs\Fashion(),
            '.film'             => new MadeITBelgium\Domainbox\TLDs\Film(),
            '.finance'          => new MadeITBelgium\Domainbox\TLDs\Finance(),
            '.financial'        => new MadeITBelgium\Domainbox\TLDs\Financial(),
            '.fish'             => new MadeITBelgium\Domainbox\TLDs\Fish(),
            '.fishing'          => new MadeITBelgium\Domainbox\TLDs\Fishing(),
            '.fit'              => new MadeITBelgium\Domainbox\TLDs\Fit(),
            '.fitness'          => new MadeITBelgium\Domainbox\TLDs\Fitness(),
            '.flights'          => new MadeITBelgium\Domainbox\TLDs\Flights(),
            '.florist'          => new MadeITBelgium\Domainbox\TLDs\Florist(),
            '.flowers'          => new MadeITBelgium\Domainbox\TLDs\Flowers(),
            '.fm'               => new MadeITBelgium\Domainbox\TLDs\Fm(),
            '.football'         => new MadeITBelgium\Domainbox\TLDs\Football(),
            '.forsale'          => new MadeITBelgium\Domainbox\TLDs\Forsale(),
            '.foundation'       => new MadeITBelgium\Domainbox\TLDs\Foundation(),
            '.fr'               => new MadeITBelgium\Domainbox\TLDs\Fr(),
            '.fun'              => new MadeITBelgium\Domainbox\TLDs\Fun(),
            '.fund'             => new MadeITBelgium\Domainbox\TLDs\Fund(),
            '.furniture'        => new MadeITBelgium\Domainbox\TLDs\Furniture(),
            '.futbol'           => new MadeITBelgium\Domainbox\TLDs\Futbol(),
            '.fyi'              => new MadeITBelgium\Domainbox\TLDs\Fyi(),
            '.gal'              => new MadeITBelgium\Domainbox\TLDs\Gal(),
            '.gallery'          => new MadeITBelgium\Domainbox\TLDs\Gallery(),
            '.game'             => new MadeITBelgium\Domainbox\TLDs\Game(),
            '.games'            => new MadeITBelgium\Domainbox\TLDs\Games(),
            '.garden'           => new MadeITBelgium\Domainbox\TLDs\Garden(),
            '.gb.com'           => new MadeITBelgium\Domainbox\TLDs\Gbcom(),
            '.gb.net'           => new MadeITBelgium\Domainbox\TLDs\Gbnet(),
            '.geek.nz'          => new MadeITBelgium\Domainbox\TLDs\Geeknz(),
            '.gen.nz'           => new MadeITBelgium\Domainbox\TLDs\Gennz(),
            '.gg'               => new MadeITBelgium\Domainbox\TLDs\Gg(),
            '.gift'             => new MadeITBelgium\Domainbox\TLDs\Gift(),
            '.gifts'            => new MadeITBelgium\Domainbox\TLDs\Gifts(),
            '.gives'            => new MadeITBelgium\Domainbox\TLDs\Gives(),
            '.glass'            => new MadeITBelgium\Domainbox\TLDs\Glass(),
            '.global'           => new MadeITBelgium\Domainbox\TLDs\GlobalTld(),
            '.gmbh'             => new MadeITBelgium\Domainbox\TLDs\Gmbh(),
            '.gold'             => new MadeITBelgium\Domainbox\TLDs\Gold(),
            '.golf'             => new MadeITBelgium\Domainbox\TLDs\Golf(),
            '.gr.com'           => new MadeITBelgium\Domainbox\TLDs\Grcom(),
            '.graphics'         => new MadeITBelgium\Domainbox\TLDs\Graphics(),
            '.gratis'           => new MadeITBelgium\Domainbox\TLDs\Gratis(),
            '.green'            => new MadeITBelgium\Domainbox\TLDs\Green(),
            '.gripe'            => new MadeITBelgium\Domainbox\TLDs\Gripe(),
            '.group'            => new MadeITBelgium\Domainbox\TLDs\Group(),
            '.guide'            => new MadeITBelgium\Domainbox\TLDs\Guide(),
            '.guitars'          => new MadeITBelgium\Domainbox\TLDs\Guitars(),
            '.guru'             => new MadeITBelgium\Domainbox\TLDs\Guru(),
            '.gy'               => new MadeITBelgium\Domainbox\TLDs\Gy(),
            '.hamburg'          => new MadeITBelgium\Domainbox\TLDs\Hamburg(),
            '.haus'             => new MadeITBelgium\Domainbox\TLDs\Haus(),
            '.healthcare'       => new MadeITBelgium\Domainbox\TLDs\Healthcare(),
            '.help'             => new MadeITBelgium\Domainbox\TLDs\Help(),
            '.hiphop'           => new MadeITBelgium\Domainbox\TLDs\Hiphop(),
            '.hiv'              => new MadeITBelgium\Domainbox\TLDs\Hiv(),
            '.hn'               => new MadeITBelgium\Domainbox\TLDs\Hn(),
            '.hockey'           => new MadeITBelgium\Domainbox\TLDs\Hockey(),
            '.holdings'         => new MadeITBelgium\Domainbox\TLDs\Holdings(),
            '.holiday'          => new MadeITBelgium\Domainbox\TLDs\Holiday(),
            '.horse'            => new MadeITBelgium\Domainbox\TLDs\Horse(),
            '.host'             => new MadeITBelgium\Domainbox\TLDs\Host(),
            '.hosting'          => new MadeITBelgium\Domainbox\TLDs\Hosting(),
            '.house'            => new MadeITBelgium\Domainbox\TLDs\House(),
            '.how'              => new MadeITBelgium\Domainbox\TLDs\How(),
            '.hu.com'           => new MadeITBelgium\Domainbox\TLDs\Hucom(),
            '.hu.net'           => new MadeITBelgium\Domainbox\TLDs\Hunet(),
            '.im'               => new MadeITBelgium\Domainbox\TLDs\Im(),
            '.immo'             => new MadeITBelgium\Domainbox\TLDs\Immo(),
            '.immobilien'       => new MadeITBelgium\Domainbox\TLDs\Immobilien(),
            '.in.net'           => new MadeITBelgium\Domainbox\TLDs\Innet(),
            '.in'               => new MadeITBelgium\Domainbox\TLDs\In(),
            '.industries'       => new MadeITBelgium\Domainbox\TLDs\Industries(),
            '.info'             => new MadeITBelgium\Domainbox\TLDs\Info(),
            '.ink'              => new MadeITBelgium\Domainbox\TLDs\Ink(),
            '.institute'        => new MadeITBelgium\Domainbox\TLDs\Institute(),
            '.insure'           => new MadeITBelgium\Domainbox\TLDs\Insure(),
            '.international'    => new MadeITBelgium\Domainbox\TLDs\International(),
            '.investments'      => new MadeITBelgium\Domainbox\TLDs\Investments(),
            '.io'               => new MadeITBelgium\Domainbox\TLDs\Io(),
            '.irish'            => new MadeITBelgium\Domainbox\TLDs\Irish(),
            '.it'               => new MadeITBelgium\Domainbox\TLDs\It(),
            '.je'               => new MadeITBelgium\Domainbox\TLDs\Je(),
            '.jetzt'            => new MadeITBelgium\Domainbox\TLDs\Jetzt(),
            '.jewelry'          => new MadeITBelgium\Domainbox\TLDs\Jewelry(),
            '.joburg'           => new MadeITBelgium\Domainbox\TLDs\Joburg(),
            '.jp.net'           => new MadeITBelgium\Domainbox\TLDs\Jpnet(),
            '.jp'               => new MadeITBelgium\Domainbox\TLDs\Jp(),
            '.jpn.com'          => new MadeITBelgium\Domainbox\TLDs\Jpncom(),
            '.juegos'           => new MadeITBelgium\Domainbox\TLDs\Juegos(),
            '.kaufen'           => new MadeITBelgium\Domainbox\TLDs\Kaufen(),
            '.kim'              => new MadeITBelgium\Domainbox\TLDs\Kim(),
            '.kitchen'          => new MadeITBelgium\Domainbox\TLDs\Kitchen(),
            '.kiwi.nz'          => new MadeITBelgium\Domainbox\TLDs\Kiwinz(),
            '.kiwi'             => new MadeITBelgium\Domainbox\TLDs\Kiwi(),
            '.koeln'            => new MadeITBelgium\Domainbox\TLDs\Koeln(),
            '.kr.com'           => new MadeITBelgium\Domainbox\TLDs\Krcom(),
            '.l.lc'             => new MadeITBelgium\Domainbox\TLDs\Llc(),
            '.la'               => new MadeITBelgium\Domainbox\TLDs\La(),
            '.land'             => new MadeITBelgium\Domainbox\TLDs\Land(),
            '.lawyer'           => new MadeITBelgium\Domainbox\TLDs\Lawyer(),
            '.lc'               => new MadeITBelgium\Domainbox\TLDs\Lc(),
            '.lease'            => new MadeITBelgium\Domainbox\TLDs\Lease(),
            '.legal'            => new MadeITBelgium\Domainbox\TLDs\Legal(),
            '.li'               => new MadeITBelgium\Domainbox\TLDs\Li(),
            '.life'             => new MadeITBelgium\Domainbox\TLDs\Life(),
            '.lighting'         => new MadeITBelgium\Domainbox\TLDs\Lighting(),
            '.limited'          => new MadeITBelgium\Domainbox\TLDs\Limited(),
            '.limo'             => new MadeITBelgium\Domainbox\TLDs\Limo(),
            '.link'             => new MadeITBelgium\Domainbox\TLDs\Link(),
            '.live'             => new MadeITBelgium\Domainbox\TLDs\Live(),
            '.loan'             => new MadeITBelgium\Domainbox\TLDs\Loan(),
            '.loans'            => new MadeITBelgium\Domainbox\TLDs\Loans(),
            '.lol'              => new MadeITBelgium\Domainbox\TLDs\Lol(),
            '.london'           => new MadeITBelgium\Domainbox\TLDs\London(),
            '.love'             => new MadeITBelgium\Domainbox\TLDs\Love(),
            '.ltd'              => new MadeITBelgium\Domainbox\TLDs\Ltd(),
            '.ltd.uk'           => new MadeITBelgium\Domainbox\TLDs\Ltduk(),
            '.luxury'           => new MadeITBelgium\Domainbox\TLDs\Luxury(),
            '.lv'               => new MadeITBelgium\Domainbox\TLDs\Lv(),
            '.maison'           => new MadeITBelgium\Domainbox\TLDs\Maison(),
            '.management'       => new MadeITBelgium\Domainbox\TLDs\Management(),
            '.maori.nz'         => new MadeITBelgium\Domainbox\TLDs\Maorinz(),
            '.market'           => new MadeITBelgium\Domainbox\TLDs\Market(),
            '.marketing'        => new MadeITBelgium\Domainbox\TLDs\Marketing(),
            '.mba'              => new MadeITBelgium\Domainbox\TLDs\Mba(),
            '.me'               => new MadeITBelgium\Domainbox\TLDs\Me(),
            '.me.uk'            => new MadeITBelgium\Domainbox\TLDs\Meuk(),
            '.media'            => new MadeITBelgium\Domainbox\TLDs\Media(),
            '.memorial'         => new MadeITBelgium\Domainbox\TLDs\Memorial(),
            '.men'              => new MadeITBelgium\Domainbox\TLDs\Men(),
            '.menu'             => new MadeITBelgium\Domainbox\TLDs\Menu(),
            '.mex.com'          => new MadeITBelgium\Domainbox\TLDs\Mexcom(),
            '.miami'            => new MadeITBelgium\Domainbox\TLDs\Miami(),
            '.mn'               => new MadeITBelgium\Domainbox\TLDs\Mn(),
            '.mobi'             => new MadeITBelgium\Domainbox\TLDs\Mobi(),
            '.moda'             => new MadeITBelgium\Domainbox\TLDs\Moda(),
            '.moe'              => new MadeITBelgium\Domainbox\TLDs\Moe(),
            '.mom'              => new MadeITBelgium\Domainbox\TLDs\Mom(),
            '.money'            => new MadeITBelgium\Domainbox\TLDs\Money(),
            '.mortgage'         => new MadeITBelgium\Domainbox\TLDs\Mortgage(),
            '.movie'            => new MadeITBelgium\Domainbox\TLDs\Movie(),
            '.mu'               => new MadeITBelgium\Domainbox\TLDs\Mu(),
            '.mx'               => new MadeITBelgium\Domainbox\TLDs\Mx(),
            '.nagoya'           => new MadeITBelgium\Domainbox\TLDs\Nagoya(),
            '.name'             => new MadeITBelgium\Domainbox\TLDs\Name(),
            '.name (3rd level)' => new MadeITBelgium\Domainbox\TLDs\Name3rdLevel(),
            '.navy'             => new MadeITBelgium\Domainbox\TLDs\Navy(),
            '.net.ag'           => new MadeITBelgium\Domainbox\TLDs\Netag(),
            '.net.bz'           => new MadeITBelgium\Domainbox\TLDs\Netbz(),
            '.net.co'           => new MadeITBelgium\Domainbox\TLDs\Netco(),
            '.net.gg'           => new MadeITBelgium\Domainbox\TLDs\Netgg(),
            '.net.hn'           => new MadeITBelgium\Domainbox\TLDs\Nethn(),
            '.net.im'           => new MadeITBelgium\Domainbox\TLDs\Netim(),
            '.net.je'           => new MadeITBelgium\Domainbox\TLDs\Netje(),
            '.net.lc'           => new MadeITBelgium\Domainbox\TLDs\Netlc(),
            '.net.nz'           => new MadeITBelgium\Domainbox\TLDs\Netnz(),
            '.net'              => new MadeITBelgium\Domainbox\TLDs\Net(),
            '.net.pl'           => new MadeITBelgium\Domainbox\TLDs\Netpl(),
            '.net.sc'           => new MadeITBelgium\Domainbox\TLDs\Netsc(),
            '.net.uk'           => new MadeITBelgium\Domainbox\TLDs\Netuk(),
            '.net.vc'           => new MadeITBelgium\Domainbox\TLDs\Netvc(),
            '.network'          => new MadeITBelgium\Domainbox\TLDs\Network(),
            '.news'             => new MadeITBelgium\Domainbox\TLDs\News(),
            '.ninja'            => new MadeITBelgium\Domainbox\TLDs\Ninja(),
            '.nl'               => new MadeITBelgium\Domainbox\TLDs\Nl(),
            '.no.com'           => new MadeITBelgium\Domainbox\TLDs\Nocom(),
            '.nom.ag'           => new MadeITBelgium\Domainbox\TLDs\Nomag(),
            '.nom.co'           => new MadeITBelgium\Domainbox\TLDs\Nomco(),
            '.nom.es'           => new MadeITBelgium\Domainbox\TLDs\Nomes(),
            '.nrw'              => new MadeITBelgium\Domainbox\TLDs\Nrw(),
            '.nyc'              => new MadeITBelgium\Domainbox\TLDs\Nyc(),
            '.nz'               => new MadeITBelgium\Domainbox\TLDs\Nz(),
            '.okinawa'          => new MadeITBelgium\Domainbox\TLDs\Okinawa(),
            '.onl'              => new MadeITBelgium\Domainbox\TLDs\Onl(),
            '.online'           => new MadeITBelgium\Domainbox\TLDs\Online(),
            '.or.at'            => new MadeITBelgium\Domainbox\TLDs\Orat(),
            '.org.ag'           => new MadeITBelgium\Domainbox\TLDs\Orgag(),
            '.org.es'           => new MadeITBelgium\Domainbox\TLDs\Orges(),
            '.org.gg'           => new MadeITBelgium\Domainbox\TLDs\Orggg(),
            '.org.hn'           => new MadeITBelgium\Domainbox\TLDs\Orghn(),
            '.org.im'           => new MadeITBelgium\Domainbox\TLDs\Orgim(),
            '.org.je'           => new MadeITBelgium\Domainbox\TLDs\Orgje(),
            '.org.lc'           => new MadeITBelgium\Domainbox\TLDs\Orglc(),
            '.org.nz'           => new MadeITBelgium\Domainbox\TLDs\Orgnz(),
            '.org'              => new MadeITBelgium\Domainbox\TLDs\Org(),
            '.org.sc'           => new MadeITBelgium\Domainbox\TLDs\Orgsc(),
            '.org.uk'           => new MadeITBelgium\Domainbox\TLDs\Orguk(),
            '.org.vc'           => new MadeITBelgium\Domainbox\TLDs\Orgvc(),
            '.p.lc'             => new MadeITBelgium\Domainbox\TLDs\Plc(),
            '.partners'         => new MadeITBelgium\Domainbox\TLDs\Partners(),
            '.parts'            => new MadeITBelgium\Domainbox\TLDs\Parts(),
            '.party'            => new MadeITBelgium\Domainbox\TLDs\Party(),
            '.photo'            => new MadeITBelgium\Domainbox\TLDs\Photo(),
            '.photography'      => new MadeITBelgium\Domainbox\TLDs\Photography(),
            '.photos'           => new MadeITBelgium\Domainbox\TLDs\Photos(),
            '.pics'             => new MadeITBelgium\Domainbox\TLDs\Pics(),
            '.pictures'         => new MadeITBelgium\Domainbox\TLDs\Pictures(),
            '.pink'             => new MadeITBelgium\Domainbox\TLDs\Pink(),
            '.pizza'            => new MadeITBelgium\Domainbox\TLDs\Pizza(),
            '.pl'               => new MadeITBelgium\Domainbox\TLDs\Pl(),
            '.place'            => new MadeITBelgium\Domainbox\TLDs\Place(),
            '.plc.uk'           => new MadeITBelgium\Domainbox\TLDs\Plcuk(),
            '.plumbing'         => new MadeITBelgium\Domainbox\TLDs\Plumbing(),
            '.plus'             => new MadeITBelgium\Domainbox\TLDs\Plus(),
            '.pm'               => new MadeITBelgium\Domainbox\TLDs\Pm(),
            '.poker'            => new MadeITBelgium\Domainbox\TLDs\Poker(),
            '.porn'             => new MadeITBelgium\Domainbox\TLDs\Porn(),
            '.press'            => new MadeITBelgium\Domainbox\TLDs\Press(),
            '.pro'              => new MadeITBelgium\Domainbox\TLDs\Pro(),
            '.productions'      => new MadeITBelgium\Domainbox\TLDs\Productions(),
            '.properties'       => new MadeITBelgium\Domainbox\TLDs\Properties(),
            '.property'         => new MadeITBelgium\Domainbox\TLDs\Property(),
            '.protection'       => new MadeITBelgium\Domainbox\TLDs\Protection(),
            '.pub'              => new MadeITBelgium\Domainbox\TLDs\Pub(),
            '.pw'               => new MadeITBelgium\Domainbox\TLDs\Pw(),
            '.qa'               => new MadeITBelgium\Domainbox\TLDs\Qa(),
            '.qc.com'           => new MadeITBelgium\Domainbox\TLDs\Qccom(),
            '.qpon'             => new MadeITBelgium\Domainbox\TLDs\Qpon(),
            '.quebec'           => new MadeITBelgium\Domainbox\TLDs\Quebec(),
            '.racing'           => new MadeITBelgium\Domainbox\TLDs\Racing(),
            '.re'               => new MadeITBelgium\Domainbox\TLDs\Re(),
            '.recipes'          => new MadeITBelgium\Domainbox\TLDs\Recipes(),
            '.red'              => new MadeITBelgium\Domainbox\TLDs\Red(),
            '.rehab'            => new MadeITBelgium\Domainbox\TLDs\Rehab(),
            '.reise'            => new MadeITBelgium\Domainbox\TLDs\Reise(),
            '.reisen'           => new MadeITBelgium\Domainbox\TLDs\Reisen(),
            '.rent'             => new MadeITBelgium\Domainbox\TLDs\Rent(),
            '.rentals'          => new MadeITBelgium\Domainbox\TLDs\Rentals(),
            '.repair'           => new MadeITBelgium\Domainbox\TLDs\Repair(),
            '.report'           => new MadeITBelgium\Domainbox\TLDs\Report(),
            '.republican'       => new MadeITBelgium\Domainbox\TLDs\Republican(),
            '.rest'             => new MadeITBelgium\Domainbox\TLDs\Rest(),
            '.restaurant'       => new MadeITBelgium\Domainbox\TLDs\Restaurant(),
            '.review'           => new MadeITBelgium\Domainbox\TLDs\Review(),
            '.reviews'          => new MadeITBelgium\Domainbox\TLDs\Reviews(),
            '.rich'             => new MadeITBelgium\Domainbox\TLDs\Rich(),
            '.rip'              => new MadeITBelgium\Domainbox\TLDs\Rip(),
            '.rocks'            => new MadeITBelgium\Domainbox\TLDs\Rocks(),
            '.rodeo'            => new MadeITBelgium\Domainbox\TLDs\Rodeo(),
            '.ru.com'           => new MadeITBelgium\Domainbox\TLDs\Rucom(),
            '.ruhr'             => new MadeITBelgium\Domainbox\TLDs\Ruhr(),
            '.run'              => new MadeITBelgium\Domainbox\TLDs\Run(),
            '.ryukyu'           => new MadeITBelgium\Domainbox\TLDs\Ryukyu(),
            '.sa.com'           => new MadeITBelgium\Domainbox\TLDs\Sacom(),
            '.saarland'         => new MadeITBelgium\Domainbox\TLDs\Saarland(),
            '.sale'             => new MadeITBelgium\Domainbox\TLDs\Sale(),
            '.salon'            => new MadeITBelgium\Domainbox\TLDs\Salon(),
            '.sarl'             => new MadeITBelgium\Domainbox\TLDs\Sarl(),
            '.sc'               => new MadeITBelgium\Domainbox\TLDs\Sc(),
            '.sch.uk'           => new MadeITBelgium\Domainbox\TLDs\Schuk(),
            '.school.nz'        => new MadeITBelgium\Domainbox\TLDs\Schoolnz(),
            '.school'           => new MadeITBelgium\Domainbox\TLDs\School(),
            '.schule'           => new MadeITBelgium\Domainbox\TLDs\Schule(),
            '.science'          => new MadeITBelgium\Domainbox\TLDs\Science(),
            '.scot'             => new MadeITBelgium\Domainbox\TLDs\Scot(),
            '.se.com'           => new MadeITBelgium\Domainbox\TLDs\Secom(),
            '.se.net'           => new MadeITBelgium\Domainbox\TLDs\Senet(),
            '.security'         => new MadeITBelgium\Domainbox\TLDs\Security(),
            '.services'         => new MadeITBelgium\Domainbox\TLDs\Services(),
            '.sex'              => new MadeITBelgium\Domainbox\TLDs\Sex(),
            '.sexy'             => new MadeITBelgium\Domainbox\TLDs\Sexy(),
            '.sh'               => new MadeITBelgium\Domainbox\TLDs\Sh(),
            '.shiksha'          => new MadeITBelgium\Domainbox\TLDs\Shiksha(),
            '.shoes'            => new MadeITBelgium\Domainbox\TLDs\Shoes(),
            '.shop'             => new MadeITBelgium\Domainbox\TLDs\Shop(),
            '.shopping'         => new MadeITBelgium\Domainbox\TLDs\Shopping(),
            '.show'             => new MadeITBelgium\Domainbox\TLDs\Show(),
            '.singles'          => new MadeITBelgium\Domainbox\TLDs\Singles(),
            '.site'             => new MadeITBelgium\Domainbox\TLDs\Site(),
            '.ski'              => new MadeITBelgium\Domainbox\TLDs\Ski(),
            '.so'               => new MadeITBelgium\Domainbox\TLDs\So(),
            '.soccer'           => new MadeITBelgium\Domainbox\TLDs\Soccer(),
            '.social'           => new MadeITBelgium\Domainbox\TLDs\Social(),
            '.software'         => new MadeITBelgium\Domainbox\TLDs\Software(),
            '.solar'            => new MadeITBelgium\Domainbox\TLDs\Solar(),
            '.solutions'        => new MadeITBelgium\Domainbox\TLDs\Solutions(),
            '.soy'              => new MadeITBelgium\Domainbox\TLDs\Soy(),
            '.space'            => new MadeITBelgium\Domainbox\TLDs\Space(),
            '.store'            => new MadeITBelgium\Domainbox\TLDs\Store(),
            '.studio'           => new MadeITBelgium\Domainbox\TLDs\Studio(),
            '.study'            => new MadeITBelgium\Domainbox\TLDs\Study(),
            '.style'            => new MadeITBelgium\Domainbox\TLDs\Style(),
            '.sucks'            => new MadeITBelgium\Domainbox\TLDs\Sucks(),
            '.supplies'         => new MadeITBelgium\Domainbox\TLDs\Supplies(),
            '.supply'           => new MadeITBelgium\Domainbox\TLDs\Supply(),
            '.support'          => new MadeITBelgium\Domainbox\TLDs\Support(),
            '.surf'             => new MadeITBelgium\Domainbox\TLDs\Surf(),
            '.surgery'          => new MadeITBelgium\Domainbox\TLDs\Surgery(),
            '.sx'               => new MadeITBelgium\Domainbox\TLDs\Sx(),
            '.systems'          => new MadeITBelgium\Domainbox\TLDs\Systems(),
            '.tattoo'           => new MadeITBelgium\Domainbox\TLDs\Tattoo(),
            '.tax'              => new MadeITBelgium\Domainbox\TLDs\Tax(),
            '.taxi'             => new MadeITBelgium\Domainbox\TLDs\Taxi(),
            '.team'             => new MadeITBelgium\Domainbox\TLDs\Team(),
            '.tech'             => new MadeITBelgium\Domainbox\TLDs\Tech(),
            '.technology'       => new MadeITBelgium\Domainbox\TLDs\Technology(),
            '.tel'              => new MadeITBelgium\Domainbox\TLDs\Tel(),
            '.tennis'           => new MadeITBelgium\Domainbox\TLDs\Tennis(),
            '.tf'               => new MadeITBelgium\Domainbox\TLDs\Tf(),
            '.theater'          => new MadeITBelgium\Domainbox\TLDs\Theater(),
            '.theatre'          => new MadeITBelgium\Domainbox\TLDs\Theatre(),
            '.tienda'           => new MadeITBelgium\Domainbox\TLDs\Tienda(),
            '.tips'             => new MadeITBelgium\Domainbox\TLDs\Tips(),
            '.tires'            => new MadeITBelgium\Domainbox\TLDs\Tires(),
            '.tk'               => new MadeITBelgium\Domainbox\TLDs\Tk(),
            '.today'            => new MadeITBelgium\Domainbox\TLDs\Today(),
            '.tokyo'            => new MadeITBelgium\Domainbox\TLDs\Tokyo(),
            '.tools'            => new MadeITBelgium\Domainbox\TLDs\Tools(),
            '.tours'            => new MadeITBelgium\Domainbox\TLDs\Tours(),
            '.town'             => new MadeITBelgium\Domainbox\TLDs\Town(),
            '.toys'             => new MadeITBelgium\Domainbox\TLDs\Toys(),
            '.trade'            => new MadeITBelgium\Domainbox\TLDs\Trade(),
            '.training'         => new MadeITBelgium\Domainbox\TLDs\Training(),
            '.tube'             => new MadeITBelgium\Domainbox\TLDs\Tube(),
            '.tv'               => new MadeITBelgium\Domainbox\TLDs\Tv(),
            '.uk.com'           => new MadeITBelgium\Domainbox\TLDs\Ukcom(),
            '.uk.net'           => new MadeITBelgium\Domainbox\TLDs\Uknet(),
            '.uk'               => new MadeITBelgium\Domainbox\TLDs\Uk(),
            '.university'       => new MadeITBelgium\Domainbox\TLDs\University(),
            '.uno'              => new MadeITBelgium\Domainbox\TLDs\Uno(),
            '.us.com'           => new MadeITBelgium\Domainbox\TLDs\Uscom(),
            '.us.org'           => new MadeITBelgium\Domainbox\TLDs\Usorg(),
            '.us'               => new MadeITBelgium\Domainbox\TLDs\Us(),
            '.uy.com'           => new MadeITBelgium\Domainbox\TLDs\Uycom(),
            '.vacations'        => new MadeITBelgium\Domainbox\TLDs\Vacations(),
            '.vc'               => new MadeITBelgium\Domainbox\TLDs\Vc(),
            '.vegas'            => new MadeITBelgium\Domainbox\TLDs\Vegas(),
            '.ventures'         => new MadeITBelgium\Domainbox\TLDs\Ventures(),
            '.versicherung'     => new MadeITBelgium\Domainbox\TLDs\Versicherung(),
            '.vet'              => new MadeITBelgium\Domainbox\TLDs\Vet(),
            '.viajes'           => new MadeITBelgium\Domainbox\TLDs\Viajes(),
            '.video'            => new MadeITBelgium\Domainbox\TLDs\Video(),
            '.villas'           => new MadeITBelgium\Domainbox\TLDs\Villas(),
            '.vin'              => new MadeITBelgium\Domainbox\TLDs\Vin(),
            '.vip'              => new MadeITBelgium\Domainbox\TLDs\Vip(),
            '.vision'           => new MadeITBelgium\Domainbox\TLDs\Vision(),
            '.vodka'            => new MadeITBelgium\Domainbox\TLDs\Vodka(),
            '.vote'             => new MadeITBelgium\Domainbox\TLDs\Vote(),
            '.voting'           => new MadeITBelgium\Domainbox\TLDs\Voting(),
            '.voto'             => new MadeITBelgium\Domainbox\TLDs\Voto(),
            '.voyage'           => new MadeITBelgium\Domainbox\TLDs\Voyage(),
            '.wales'            => new MadeITBelgium\Domainbox\TLDs\Wales(),
            '.watch'            => new MadeITBelgium\Domainbox\TLDs\Watch(),
            '.webcam'           => new MadeITBelgium\Domainbox\TLDs\Webcam(),
            '.website'          => new MadeITBelgium\Domainbox\TLDs\Website(),
            '.wedding'          => new MadeITBelgium\Domainbox\TLDs\Wedding(),
            '.wf'               => new MadeITBelgium\Domainbox\TLDs\Wf(),
            '.wien'             => new MadeITBelgium\Domainbox\TLDs\Wien(),
            '.wiki'             => new MadeITBelgium\Domainbox\TLDs\Wiki(),
            '.win'              => new MadeITBelgium\Domainbox\TLDs\Win(),
            '.wine'             => new MadeITBelgium\Domainbox\TLDs\Wine(),
            '.work'             => new MadeITBelgium\Domainbox\TLDs\Work(),
            '.works'            => new MadeITBelgium\Domainbox\TLDs\Works(),
            '.world'            => new MadeITBelgium\Domainbox\TLDs\World(),
            '.ws'               => new MadeITBelgium\Domainbox\TLDs\Ws(),
            '.wtf'              => new MadeITBelgium\Domainbox\TLDs\Wtf(),
            '.网站'               => new MadeITBelgium\Domainbox\TLDs\Xn5tzm5g(),
            '.xxx'              => new MadeITBelgium\Domainbox\TLDs\Xxx(),
            '.xyz'              => new MadeITBelgium\Domainbox\TLDs\Xyz(),
            '.yoga'             => new MadeITBelgium\Domainbox\TLDs\Yoga(),
            '.yokohama'         => new MadeITBelgium\Domainbox\TLDs\Yokohama(),
            '.yt'               => new MadeITBelgium\Domainbox\TLDs\Yt(),
            '.za.com'           => new MadeITBelgium\Domainbox\TLDs\Zacom(),
            '.zone'             => new MadeITBelgium\Domainbox\TLDs\Zone(),
        ], TLD::getAllTLDs());
    }

    public function providerDomains()
    {
        return [
            [
                '.ac.nz',
                'MadeITBelgium\Domainbox\TLDs\Acnz',
                ['tld' => '.ac.nz', 'idnTLD' => 'ac.nz', 'dnsName' => 'ac.nz', 'periods' => null, 'fee_registry' => 16, 'fee_renew' => 16, 'fee_transfer' => 16, 'fee_domainbox' => 9, 'fee_icann' => 0, 'fee_setup' => 0, 'fee_application' => 0, 'fee_total' => 25, 'fee_restore' => null, 'fee_backorder' => null, 'type' => 'ccTLD', 'applyLock' => false, 'applyPrivacy' => false, 'numberOfNameServers' => 10, 'dnssec' => false, 'ipv6' => true, 'ipv4' => true, 'refund' => false, 'refundPeriodAdd' => 5, 'refundPeriodTransfer' => 0, 'refundPeriodRenew' => 5, 'refundLimit' => 0],
            ],
            [
                '.ac.nz',
                'MadeITBelgium\Domainbox\TLDs\Acnz',
                ['tld' => '.ac.nz', 'idnTLD' => 'ac.nz', 'dnsName' => 'ac.nz', 'periods' => null, 'fee_registry' => 16, 'fee_renew' => 16, 'fee_transfer' => 16, 'fee_domainbox' => 9, 'fee_icann' => 0, 'fee_setup' => 0, 'fee_application' => 0, 'fee_total' => 25, 'fee_restore' => null, 'fee_backorder' => null, 'type' => 'ccTLD', 'applyLock' => false, 'applyPrivacy' => false, 'numberOfNameServers' => 10, 'dnssec' => false, 'ipv6' => true, 'ipv4' => true, 'refund' => false, 'refundPeriodAdd' => 5, 'refundPeriodTransfer' => 0, 'refundPeriodRenew' => 5, 'refundLimit' => 0],
            ],
        ];
    }

    /**
     * This is kind of a smoke test.
     *
     * @dataProvider providerDomains
     **/
    public function testTlds($tld, $class, $options)
    {
        $tld = new $class();
        $this->assertEquals($options['tld'], $tld->getTld());
        $this->assertEquals($options['idnTLD'], $tld->getIdnTld());
        $this->assertEquals($options['dnsName'], $tld->getDnsName());
        $this->assertEquals($options['periods'], $tld->getPeriods());
        $this->assertEquals($options['fee_registry'], $tld->getFee_registry());
        $this->assertEquals($options['fee_renew'], $tld->getFee_renew());
        $this->assertEquals($options['fee_transfer'], $tld->getFee_transfer());
        $this->assertEquals($options['fee_domainbox'], $tld->getFee_domainbox());
        $this->assertEquals($options['fee_icann'], $tld->getFee_icann());
        $this->assertEquals($options['fee_setup'], $tld->getFee_setup());
        $this->assertEquals($options['fee_application'], $tld->getFee_application());
        $this->assertEquals($options['fee_total'], $tld->getFee_total());
        $this->assertEquals($options['fee_restore'], $tld->getFee_restore());
        $this->assertEquals($options['fee_backorder'], $tld->getFee_backorder());
        $this->assertEquals($options['type'], $tld->getType());
        $this->assertEquals($options['applyLock'], $tld->getApplyLock());
        $this->assertEquals($options['applyPrivacy'], $tld->getApplyPrivacy());
        $this->assertEquals($options['numberOfNameServers'], $tld->getNumberOfNameServers());
        $this->assertEquals($options['dnssec'], $tld->getDnssec());
        $this->assertEquals($options['ipv6'], $tld->getIpv6());
        $this->assertEquals($options['ipv4'], $tld->getIpv4());
        $this->assertEquals($options['refund'], $tld->getRefund());
        $this->assertEquals($options['refundPeriodRenew'], $tld->getRefundPeriodRenew());
        $this->assertEquals($options['refundLimit'], $tld->getRefundLimit());
    }

    public function testTLDSets()
    {
        $tld = new MadeITBelgium\Domainbox\TLDs\TLD();

        $tld->setTld('test');
        $this->assertEquals('test', $tld->getTld());

        $tld->setIdnTLD('test');
        $this->assertEquals('test', $tld->getIdnTLD());

        $tld->setDnsName('test');
        $this->assertEquals('test', $tld->getDnsName());

        $tld->setPeriods('test');
        $this->assertEquals('test', $tld->getPeriods());

        $tld->setFee_registry('test');
        $this->assertEquals('test', $tld->getFee_registry());

        $tld->setFee_renew('test');
        $this->assertEquals('test', $tld->getFee_renew());

        $tld->setFee_transfer('test');
        $this->assertEquals('test', $tld->getFee_transfer());

        $tld->setFee_domainbox('test');
        $this->assertEquals('test', $tld->getFee_domainbox());

        $tld->setFee_icann('test');
        $this->assertEquals('test', $tld->getFee_icann());

        $tld->setFee_setup('test');
        $this->assertEquals('test', $tld->getFee_setup());

        $tld->setFee_application('test');
        $this->assertEquals('test', $tld->getFee_application());

        $tld->setFee_total('test');
        $this->assertEquals('test', $tld->getFee_total());

        $tld->setFee_restore('test');
        $this->assertEquals('test', $tld->getFee_restore());

        $tld->setFee_backorder('test');
        $this->assertEquals('test', $tld->getFee_backorder());

        $tld->setNumberOfCategories('test');
        $this->assertEquals('test', $tld->getNumberOfCategories());

        $tld->setCategories('test');
        $this->assertEquals('test', $tld->getCategories());

        $tld->setType('test');
        $this->assertEquals('test', $tld->getType());

        $tld->setLaunchPhase('test');
        $this->assertEquals('test', $tld->getLaunchPhase());

        $tld->setApplyLock('test');
        $this->assertEquals('test', $tld->getApplyLock());

        $tld->setAutoRenew('test');
        $this->assertEquals('test', $tld->getAutoRenew());

        $tld->setAutoRenewDays('test');
        $this->assertEquals('test', $tld->getAutoRenewDays());

        $tld->setAutoRenewDaysDefault('test');
        $this->assertEquals('test', $tld->getAutoRenewDaysDefault());

        $tld->setApplyPrivacy('test');
        $this->assertEquals('test', $tld->getApplyPrivacy());

        $tld->setAcceptTerms('test');
        $this->assertEquals('test', $tld->getAcceptTerms());

        $tld->setNumberOfNameServers('test');
        $this->assertEquals('test', $tld->getNumberOfNameServers());

        $tld->setExtension('test');
        $this->assertEquals('test', $tld->getExtension());

        $tld->setAdditionalData('test');
        $this->assertEquals('test', $tld->getAdditionalData());

        $tld->setLaunchDate('test');
        $this->assertEquals('test', $tld->getLaunchDate());

        $tld->setDnssec('test');
        $this->assertEquals('test', $tld->getDnssec());

        $tld->setIpv6('test');
        $this->assertEquals('test', $tld->getIpv6());

        $tld->setIpv4('test');
        $this->assertEquals('test', $tld->getIpv4());

        $tld->setCanChangeContact('test');
        $this->assertEquals('test', $tld->getCanChangeContact());

        $tld->setCanChangeContactOrganisation('test');
        $this->assertEquals('test', $tld->getCanChangeContactOrganisation());

        $tld->setCanChangeContactName('test');
        $this->assertEquals('test', $tld->getCanChangeContactName());

        $tld->setCanChangeContactBirth('test');
        $this->assertEquals('test', $tld->getCanChangeContactBirth());

        $tld->setCanChangeContactFax('test');
        $this->assertEquals('test', $tld->getCanChangeContactFax());

        $tld->setCanChangeContactCountryCode('test');
        $this->assertEquals('test', $tld->getCanChangeContactCountryCode());

        $tld->setCanChangeContactEntityType('test');
        $this->assertEquals('test', $tld->getCanChangeContactEntityType());

        $tld->setCanChangeContactNationality('test');
        $this->assertEquals('test', $tld->getCanChangeContactNationality());

        $tld->setCanChangeContactRegCode('test');
        $this->assertEquals('test', $tld->getCanChangeContactRegCode());

        $tld->setDomainRenewBeforeMin('test');
        $this->assertEquals('test', $tld->getDomainRenewBeforeMin());

        $tld->setDomainRenewBeforeMax('test');
        $this->assertEquals('test', $tld->getDomainRenewBeforeMax());

        $tld->setRenewPeriods('test');
        $this->assertEquals('test', $tld->getRenewPeriods());

        $tld->setRefund('test');
        $this->assertEquals('test', $tld->getRefund());

        $tld->setRefundPeriodAdd('test');
        $this->assertEquals('test', $tld->getRefundPeriodAdd());

        $tld->setRefundPeriodTransfer('test');
        $this->assertEquals('test', $tld->getRefundPeriodTransfer());

        $tld->setRefundPeriodRenew('test');
        $this->assertEquals('test', $tld->getRefundPeriodRenew());

        $tld->setRefundLimit('test');
        $this->assertEquals('test', $tld->getRefundLimit());

        $tld->setDnsVerification('test');
        $this->assertEquals('test', $tld->getDnsVerification());

        $tld->setRegisterText('test');
        $this->assertEquals('test', $tld->getRegisterText());
    }
}
