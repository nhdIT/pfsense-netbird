PORTNAME=	netbird
DISTVERSION=	0.29.0
DISTVERSIONPREFIX=	v
CATEGORIES=	net security net-vpn

WRKSRC=		${WRKDIR}/netbird-${PORTVERSION}

MAINTAINER=	rdeweese@nhdit.com
COMMENT=	Mesh VPN
WWW=		https://netbird.io/

LICENSE=        BSD3CLAUSE
LICENSE_FILE=   ${WRKSRC}/LICENSE

USES=		go:1.22,modules

GO_MODULE=	github.com/netbirdio/netbird

USE_RC_SUBR=	netbird

GO_TARGET=	./client:netbird
GO_BUILDFLAGS=   -tags freebsd -o ${PORTNAME} -ldflags "\
                 -s -w -X github.com/netbirdio/netbird/version.version=${PORTVERSION} -extldflags '-static'"

PLIST_FILES=	bin/netbird


.include <bsd.port.mk>
